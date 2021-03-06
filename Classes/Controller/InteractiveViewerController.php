<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with TYPO3 source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Causal\Sphinx\Controller;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use Causal\Sphinx\Utility\MiscUtility;

/**
 * Interactive Documentation Viewer for the 'sphinx' extension.
 *
 * @category    Backend Module
 * @package     TYPO3
 * @subpackage  tx_sphinx
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class InteractiveViewerController extends AbstractActionController
{

    /** @var \Causal\Restdoc\Reader\SphinxJson */
    protected $sphinxReader;

    /** @var string */
    protected $reference;

    /** @var string */
    protected $extension;

    /** @var string */
    protected $languageDirectory = 'default';

    // public for use with htmlizeWarnings()
    public $uriBuilder;

    /**
     * Unfortunately cannot use inject method as EXT:restdoc may not be loaded.
     *
     * @return void
     */
    protected function initializeAction()
    {
        if (ExtensionManagementUtility::isLoaded('restdoc')) {
            $this->sphinxReader = GeneralUtility::makeInstance(\Causal\Restdoc\Reader\SphinxJson::class);
            $this->sphinxReader
                ->setKeepPermanentLinks(false)
                ->setDefaultFile('Index')
                ->enableDefaultDocumentFallback();
        }
    }

    /**
     * Render action.
     *
     * @param string $reference Reference of a documentation
     * @param string $document Name of the document/chapter to show
     * @param string $documentationFilename Absolute path to the corresponding documentation source file
     * @return void|string
     * @throws \RuntimeException
     */
    protected function renderAction($reference, $document = '', $documentationFilename = '')
    {
        $this->checkExtensionRestdoc();
        $this->reference = $reference;

        if (empty($document)) {
            $document = $this->getBackendUser()->getModuleData('help_documentation/DocumentationController/reference-' . $reference);
        }

        list($type, $identifier) = explode(':', $reference, 2);
        switch ($type) {
            case 'EXT':
                list($extensionKey, $locale) = explode('.', $identifier, 2);
                $this->languageDirectory = empty($locale) ? 'default' : $locale;
                $this->extension = $extensionKey;
                $path = GeneralUtility::getFileAbsFileName('typo3conf/Documentation/typo3cms.extensions.' . $extensionKey . '/' . $this->languageDirectory . '/json');
                break;
            case 'USER':
                if (is_file($documentationFilename)) {
                    $path = PathUtility::dirname($documentationFilename);
                } else {
                    $path = '';
                    $this->signalSlotDispatcher->dispatch(
                        __CLASS__,
                        'retrieveBasePath',
                        [
                            'identifier' => $identifier,
                            'path' => &$path,
                        ]
                    );
                }
                break;
            default:
                throw new \RuntimeException('Unknown reference "' . $reference . '"', 1371163248);
        }

        if (empty($document)) {
            $document = $this->sphinxReader->getDefaultFile() . '/';
        }

        if (!is_dir($path)) {
            return 'Path ' . $path . ' cannot be resolved. You probably have a write permission issue.';
        }

        $this->sphinxReader
            ->setPath($path)
            ->setDocument($document)
            ->load();

        // Store preferences
        $this->getBackendUser()->pushModuleData('help_documentation/DocumentationController/reference-' . $reference, $document);

        /** @var \Causal\Sphinx\Domain\Model\Documentation $documentation */
        $documentation = GeneralUtility::makeInstance(\Causal\Sphinx\Domain\Model\Documentation::class, $this->sphinxReader);
        $documentation->setCallbackLinks([$this, 'getLink']);
        $documentation->setCallbackImages([$this, 'processImage']);

        $this->view->assign('documentation', $documentation);
        $this->view->assign('reference', $reference);
        $this->view->assign('document', $document);

        $warningsFilename = '';
        if (file_exists($path . '/warnings.txt')) {
            $warningsFilename = $this->htmlizeWarnings($path, $reference);
            if ($this->hasErrors($path . '/warnings.txt')) {
                $fileName = preg_replace('#^.*/typo3temp/#', 'typo3temp/', $warningsFilename);
                $errors = file_get_contents(PATH_site . $fileName);
                if (preg_match('#<body>(.*)</body>#s', $errors, $matches)) {
                    $this->view->assign('errors', $matches[1]);
                }
            }
        }

        $buttons = $this->getButtons($reference, $document, $warningsFilename);
        $this->view->assign('buttons', $buttons);

        $this->view->assign('editUrl', $this->getEditUrl($reference, $document, true));
    }

    /**
     * Missing EXT:restdoc action.
     *
     * @return void
     */
    protected function missingRestdocAction()
    {
        $extensionManagerUri = MiscUtility::getExtensionManagerLink();
        $this->view->assign('extensionManagerUri', $extensionManagerUri);
    }

    /**
     * Outdated EXT:restdoc action.
     *
     * @return void
     */
    protected function outdatedRestdocAction()
    {
        // Nothing to do
    }

    /**
     * Checks that EXT:restdoc is properly available.
     *
     * @return void
     */
    protected function checkExtensionRestdoc()
    {
        if (!ExtensionManagementUtility::isLoaded('restdoc')) {
            $this->forward('missingRestdoc');
        }
        try {
            $restdocVersion = ExtensionManagementUtility::getExtensionVersion('restdoc');
        } catch (\TYPO3\CMS\Core\Package\Exception $exception) {
            // Possible problem as described on https://forge.typo3.org/issues/70175
            $EM_CONF = [];
            $_EXTKEY = 'restdoc';
            include(ExtensionManagementUtility::extPath($_EXTKEY) . 'ext_emconf.php');
            $restdocVersion = $EM_CONF[$_EXTKEY]['version'];
        }

        // Removes -dev -alpha -beta -RC states from a version number
        // and replaces them by .0
        if (stripos($restdocVersion, '-dev') || stripos($restdocVersion, '-alpha') || stripos($restdocVersion, '-beta') || stripos($restdocVersion, '-RC')) {
            // Find the last occurence of "-" and replace that part with a ".0"
            $restdocVersion = substr($restdocVersion, 0, strrpos($restdocVersion, '-')) . '.0';
        }

        $metadata = MiscUtility::getExtensionMetaData($this->request->getControllerExtensionKey());
        list($minVersion, $_) = explode('-', $metadata['constraints']['suggests']['restdoc']);

        if (version_compare($restdocVersion, $minVersion, '<')) {
            $this->forward('outdatedRestdoc');
        }
    }

    /**
     * Generates a link to navigate within a reST documentation project.
     *
     * @param string $document Target document
     * @param boolean $absolute Whether absolute URI should be generated
     * @param integer $rootPage UID of the page showing the documentation
     * @return string
     * @throws \RuntimeException
     * @private This method is made public to be accessible from a lambda-function scope
     */
    public function getLink($document, $absolute = false, $rootPage = 0)
    {
        static $basePath = null;

        $anchor = '';
        if ($document !== '') {
            if (($pos = strrpos($document, '#')) !== false) {
                $anchor = substr($document, $pos + 1);
                $document = substr($document, 0, $pos);
            }
        }
        $link = $this->uriBuilder->uriFor(
            'render',
            [
                'reference' => $this->reference,
                'document' => $document
            ]
        );
        switch (true) {
            case $anchor !== '':
                $link .= '#' . $anchor;
                break;
            case substr($document, 0, 11) === '_downloads/':
            case substr($document, 0, 8) === '_images/':
            case substr($document, 0, 9) === '_sources/':
                list($type, $identifier) = explode(':', $this->reference, 2);
                switch ($type) {
                    case 'EXT':
                        $link = '../typo3conf/Documentation/typo3cms.extensions.' . $this->extension . '/' . $this->languageDirectory . '/json/' . $document;
                        break;
                    case 'USER':
                        if ($basePath === null) {
                            $basePath = '';
                            $this->signalSlotDispatcher->dispatch(
                                __CLASS__,
                                'retrieveBasePath',
                                [
                                    'identifier' => $identifier,
                                    'path' => &$basePath,
                                ]
                            );
                            $basePath = substr($basePath, strlen(PATH_site));
                        }
                        $link = '../' . $basePath . $document;
                        break;
                    default:
                        throw new \RuntimeException('Unknown reference "' . $this->reference . '"', 1397042689);
                }

                break;
        }
        return $link;
    }

    /**
     * Processes an image.
     *
     * @param array $data Image information
     * @return string HTML image tag
     * @private This method is made public to be accessible from a lambda-function scope
     */
    public function processImage(array $data)
    {
        $fixedHeight = !empty($data['style']) && preg_match('/height/', $data['style']);
        if (!$fixedHeight) {
            $image = GeneralUtility::getFileAbsFileName($data['src']);
            if (is_file($image)) {
                $info = getimagesize($image);
                $data['style'] = 'max-width:' . $info[0] . 'px;' . (!empty($data['style']) ? $data['style'] : '');
            }
        }

        $tag = '<img src="../' . htmlspecialchars($data['src']) . '"';
        $tag .= ' alt="' . (!empty($data['alt']) ? htmlspecialchars($data['alt']) : '') . '"';

        // Styling
        $classes = [];
        if (!empty($data['class'])) {
            $classes = explode(' ', $data['class']);
        }
        if (!$fixedHeight) {
            $classes[] = 'img-scaling';    // From standard TYPO3 theme
        }
        if (count($classes) > 0) {
            $tag .= ' class="' . htmlspecialchars(implode(' ', array_unique($classes))) . '"';
        }
        if (!empty($data['style'])) {
            $tag .= ' style="' . htmlspecialchars($data['style']) . '"';
        }

        $tag .= ' />';
        return $tag;
    }

    /**
     * Returns the toolbar buttons.
     *
     * @param string $reference
     * @param string $document
     * @param string $warningsFilename
     * @return string
     */
    protected function getButtons($reference, $document, $warningsFilename)
    {
        $buttons = [];

        if ($document !== 'genindex/') {
            $buttons[] = $this->createToolbarButton(
                $this->getEditUrl($reference, $document),
                $this->translate('toolbar.interactive.edit'),
                'open'
            );
        }
        if (!empty($warningsFilename)) {
            $buttons[] = $this->createToolbarButton(
                $warningsFilename,
                $this->translate('toolbar.interactive.showWarnings'),
                'warning'
            );
        }

        $translations = $this->getTranslations($reference, $document);
        if (count($translations) > 0) {
            $buttons[] = '<div class="right">';
            $numberOfTranslations = count($translations);
            for ($i = 0; $i < $numberOfTranslations; $i++) {
                if ($translations[$i]['active']) {
                    $buttons[] = sprintf(
                        '<a href="#" class="btn btn-primary btn-sm active">%s</a>',
                        htmlspecialchars($translations[$i]['name'])
                    );
                } else {
                    $buttons[] = sprintf(
                        '<a class="btn btn-default btn-sm" href="%s">%s</a>',
                        $translations[$i]['link'],
                        htmlspecialchars($translations[$i]['name'])
                    );
                }
            }
            $buttons[] = '</div>';
        }

        return implode(' ', $buttons);
    }

    /**
     * Returns the edit URL for a given reference/document.
     *
     * @param string $reference
     * @param string $document
     * @param boolean $createAbsoluteUri
     * @return string
     */
    protected function getEditUrl($reference, $document, $createAbsoluteUri = false)
    {
        if ($createAbsoluteUri) {
            $this->uriBuilder->setCreateAbsoluteUri(true);
        }
        $url = $this->uriBuilder->uriFor(
            'edit',
            [
                'reference' => $reference,
                'document' => $document,
            ],
            'RestEditor'
        );
        if ($createAbsoluteUri) {
            $this->uriBuilder->setCreateAbsoluteUri(false);
        }
        return $url;
    }

    /**
     * Returns links to translate current document.
     * Note: This is currently only implemented for extension manuals.
     *
     * @param string $reference
     * @param string $document
     * @return array
     */
    protected function getTranslations($reference, $document)
    {
        $translations = [];

        list($type, $identifier) = explode(':', $reference, 2);
        if ($type === 'EXT') {
            list($extensionKey, $locale) = explode('.', $identifier, 2);

            if (empty($locale)) {
                $documentationTypes = MiscUtility::getDocumentationTypes($extensionKey);
            } else {
                $documentationTypes = MiscUtility::getLocalizedDocumentationType($extensionKey, $locale);
            }

            if ($documentationTypes & MiscUtility::DOCUMENTATION_TYPE_SPHINX) {
                $localizationDirectories = MiscUtility::getLocalizationDirectories($extensionKey);
                $extensionPath = MiscUtility::extPath($extensionKey);

                $filename = ($document ? substr($document, 0, -1) : 'Index') . '.rst';
                $absoluteFilename = $extensionPath . 'Documentation/' . $filename;
                if (is_file($absoluteFilename) && count($localizationDirectories) > 0) {
                    // Current document exists in English, will try to find a match in translated versions
                    foreach ($localizationDirectories as $localizationDirectory) {
                        $absoluteFilename = $extensionPath . $localizationDirectory['directory'] . '/' . $filename;
                        $localizationLocale = $localizationDirectory['locale'];

                        if (is_file($absoluteFilename) && !isset($translations[$localizationLocale])) {
                            $translations[$localizationLocale] = [
                                'name' => $localizationLocale,
                                'link' => $this->uriBuilder->uriFor(
                                    'index',
                                    [
                                        'reference' => 'EXT:' . $extensionKey . '.' . $localizationLocale,
                                        'document' => $document,
                                        'layout' => 'json',
                                    ],
                                    'Documentation'
                                ),
                                'active' => ($locale === $localizationLocale),
                            ];
                        }
                    }
                    if (count($translations) > 0) {
                        // Prepend English version
                        array_unshift($translations, [
                            'name' => 'en_US',
                            'link' => $this->uriBuilder->uriFor(
                                'index',
                                [
                                    'reference' => 'EXT:' . $extensionKey,
                                    'document' => $document,
                                    'layout' => 'json',
                                ],
                                'Documentation'
                            ),
                            'active' => empty($locale),
                        ]);
                    }
                }
            }
        }

        return array_values($translations);
    }

    /**
     * HTML-ize a warnings.txt file.
     *
     * @param string $path Directory containing warnings.txt
     * @param string $reference
     * @return string
     */
    protected function htmlizeWarnings($path, $reference)
    {
        $path = rtrim($path, '/') . '/';
        $mtime = filemtime($path . 'warnings.txt');
        $userToken = substr(GeneralUtility::hmac(
            $GLOBALS['BE_USER']->getSessionData('formSessionToken'),
            $GLOBALS['BE_USER']->user['uid']
        ), 0, 10);

        $cacheDirectory = GeneralUtility::getFileAbsFileName('typo3temp/tx_sphinx/');
        $cacheFiles = glob($cacheDirectory . 'warnings-' . md5($path) . '.*');
        if ($cacheFiles === false) {
            // An error occured
            $cacheFiles = [];
        }
        $validCacheFile = null;
        foreach ($cacheFiles as $cacheFile) {
            list($_, $token, $timestamp) = explode('.', PathUtility::basename($cacheFile));
            if ($timestamp != $mtime) {
                // Cache file is outdated
                @unlink($cacheFile);
            } elseif ($userToken === $token) {
                $validCacheFile = $cacheFile;
            }
        }
        if ($validCacheFile) {
            return PathUtility::getRelativePathTo(PathUtility::dirname($validCacheFile),
                PATH_site) . PathUtility::basename($validCacheFile);
        }

        // Cache does not exist or was outdated
        $contents = file_get_contents($path . 'warnings.txt');

        // Convert new lines for HTML output
        $contents = nl2br($contents);

        /** @var \Causal\Sphinx\Controller\RestEditorController $restEditorController */
        $restEditorController = $this->objectManager->get(\Causal\Sphinx\Controller\RestEditorController::class);
        $parts = $restEditorController->parseReferenceDocument($reference, 'Index/');

        $basePath = $parts['basePath'] . '/';
        if ($parts['type'] === 'EXT') {
            // $basePath is potentially the physical path (in case of symbolic link)
            // but we need a path within PATH_site to be detected and replaced
            $basePath = MiscUtility::extPath($parts['extensionKey']) . 'Documentation/';

            if (!empty($parts['locale'])) {
                $basePath .= 'Localization.' . $parts['locale'] . '/';
            }
        }

        // Compatibility with Windows platform
        $basePath = str_replace('/', DIRECTORY_SEPARATOR, $basePath);

        $self = $this;
        $contents = preg_replace_callback(
            '#' . preg_quote($basePath, '#') . '([^: ]+)(<br />|:(\d*):)#m',
            function ($matches) use ($reference, $self) {
                $filename = $matches[1];
                if (count($matches) == 4) {
                    $line = max(1, intval($matches[3]));
                    $linkPattern = '<a href="%s">%s</a>:%s:';
                } else {
                    $line = 1;
                    $linkPattern = '<a href="%s">%s</a><br />';
                }

                if (substr($filename, -4) === '.rst') {
                    $document = substr($filename, 0, -4) . '/';
                    $self->uriBuilder->setCreateAbsoluteUri(true);
                    $actionUrl = $self->uriBuilder->uriFor(
                        'edit',
                        [
                            'reference' => $reference,
                            'document' => $document,
                            'startLine' => $line,
                        ],
                        'RestEditor'
                    );
                    $self->uriBuilder->setCreateAbsoluteUri(false);

                    return sprintf(
                        $linkPattern,
                        $actionUrl,
                        htmlspecialchars($filename),
                        $line
                    );
                } else {
                    // No change to contents
                    return $matches[0];
                }
            },
            $contents
        );

        $htmlTemplate = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>$reference: warnings.txt</title>
    <style type="text/css">
        body {
            font-family: Verdana,Arial,Helvetica,sans-serif;
            font-size: 11px;
            line-height: 14px;
        }
    </style>
</head>
<body>
###CONTENTS###
</body>
</html>
HTML;

        $contents = str_replace('###CONTENTS###', $contents, $htmlTemplate);
        $cacheFile = $cacheDirectory . 'warnings-' . md5($path) . '.' . $userToken . '.' . $mtime . '.html';
        try {
            $success = GeneralUtility::writeFile($cacheFile, $contents);
        } catch (\Exception $e) {
            // Warnings (cannot write file) turned into fatals in development context
            $success = false;
        }


        if ($success) {
            $htmlFileName = PathUtility::getRelativePathTo(dirname($cacheFile), PATH_site) . PathUtility::basename($cacheFile);
        } else {
            $htmlFileName = '../' . substr($path, strlen(PATH_site)) . 'warnings.txt';
        }

        return $htmlFileName;
    }

    /**
     * Returns true if warnings.txt contains references to serious errors.
     *
     * @param string $warningsFileName
     * @return bool
     */
    protected function hasErrors($warningsFileName)
    {
        $contents = file_get_contents($warningsFileName);
        if (preg_match_all('/( ERROR: .*)|( SEVERE: .*)/', $contents, $matches)) {
            foreach ($matches[0] as $match) {
                if (!preg_match('/Unknown directive type "ref-targets-list"/', $match)) {
                    return true;
                }
            }
        }
        return false;
    }

}
