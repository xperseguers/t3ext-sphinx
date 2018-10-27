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

namespace Causal\Sphinx\Slots;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Slot implementation for EXT:documentation.
 *
 * @category    Slots
 * @package     TYPO3
 * @subpackage  tx_sphinx
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class SphinxDocumentation
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $objectManager;

    /**
     * @var \Causal\Sphinx\Domain\Repository\ExtensionRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $extensionRepository;

    /**
     * @var \Causal\Sphinx\Domain\Repository\ProjectRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $projectRepository;

    /**
     * Post-processes the list of available documents.
     *
     * @param string $language
     * @param array $documents
     * @return void
     */
    public function postProcessDocuments($language, array &$documents)
    {
        $formats = $this->getSupportedFormats();
        $unsetDocuments = array();

        if (count($formats) === 0) {
            return;
        }

        $extensionsWithSphinxDocumentation = $this->extensionRepository->findByHasSphinxDocumentation();
        foreach ($extensionsWithSphinxDocumentation as $extension) {
            /** @var \TYPO3\CMS\Documentation\Domain\Model\Document $document */
            /** @var \TYPO3\CMS\Documentation\Domain\Model\DocumentTranslation $documentTranslation */

            list($extensionKey, $locale) = explode('.', $extension->getExtensionKey());
            $packageKey = $extension->getPackageKey();

            if ($locale !== null) {
                if (!GeneralUtility::isFirstPartOfStr($locale, $language)) {
                    // Translated manual but does not match current Backend language
                    continue;
                }

                // Manual in English should thus be hidden
                $unsetDocuments[] = 'typo3cms.extensions.' . $extensionKey;
            }

            if (!isset($documents[$packageKey])) {
                $document = $this->objectManager->get(\TYPO3\CMS\Documentation\Domain\Model\Document::class)
                    ->setPackageKey($packageKey)
                    ->setExtensionKey($extensionKey)
                    ->setIcon($extension->getIcon());
                $documents[$packageKey] = $document;
            }

            $document = $documents[$packageKey];
            $documentTranslation = null;
            foreach ($document->getTranslations() as $translation) {
                /** @var \TYPO3\CMS\Documentation\Domain\Model\DocumentTranslation $translation */
                if ($translation->getLanguage() === 'default') {
                    $documentTranslation = $translation;
                    break;
                }
            }

            if ($documentTranslation === null) {
                $documentTranslation = $this->objectManager->get(\TYPO3\CMS\Documentation\Domain\Model\DocumentTranslation::class)
                    ->setLanguage($locale ?: 'default')
                    ->setTitle($extension->getTitle())
                    ->setDescription($extension->getDescription());

                $document->addTranslation($documentTranslation);
            }

            $existingFormats = array();
            foreach ($documentTranslation->getFormats() as $documentFormat) {
                /** @var $documentFormat \TYPO3\CMS\Documentation\Domain\Model\DocumentFormat */
                if ($documentFormat->getFormat() === 'sxw') {
                    // Remove OpenOffice from the list when HTML/PDF is available
                    $documentTranslation->removeFormat($documentFormat);
                    continue;
                }
                $existingFormats[$documentFormat->getFormat()] = $documentFormat;
            }

            foreach ($formats as $format) {
                if (!isset($existingFormats[$format])) {
                    /** @var \TYPO3\CMS\Documentation\Domain\Model\DocumentFormat $documentFormat */
                    $documentFormat = $this->objectManager->get(\TYPO3\CMS\Documentation\Domain\Model\DocumentFormat::class)
                        ->setFormat($format)
                        ->setPath($this->getRenderLink($extension->getExtensionKey(), $format));

                    $documentTranslation->addFormat($documentFormat);
                } else {
                    // Override path of the document to point to EXT:sphinx's renderer
                    $existingFormats[$format]->setPath($this->getRenderLink($extension->getExtensionKey(), $format));
                }
            }
        }

        $documents = array_diff_key($documents, array_flip($unsetDocuments));

        $defaultIcon = '../' . substr(
                \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('documentation') . 'ext_icon.gif',
                strlen(PATH_site)
            );
        $projects = $this->projectRepository->findAll();
        foreach ($projects as $project) {
            $packageKey = $project->getDocumentationKey();

            /** @var \TYPO3\CMS\Documentation\Domain\Model\Document $document */
            $document = $this->objectManager->get(\TYPO3\CMS\Documentation\Domain\Model\Document::class)
                ->setPackageKey($packageKey)
                ->setIcon($defaultIcon);

            /** @var \TYPO3\CMS\Documentation\Domain\Model\DocumentTranslation $documentTranslation */
            $documentTranslation = $this->objectManager->get(\TYPO3\CMS\Documentation\Domain\Model\DocumentTranslation::class)
                ->setLanguage('default')
                ->setTitle($project->getName())
                ->setDescription($project->getDescription());

            foreach ($formats as $format) {
                /** @var \TYPO3\CMS\Documentation\Domain\Model\DocumentFormat $documentFormat */
                $documentFormat = $this->objectManager->get(\TYPO3\CMS\Documentation\Domain\Model\DocumentFormat::class)
                    ->setFormat($format)
                    ->setPath($this->getRenderLink($project->getDocumentationKey(), $format, 'USER'));

                $documentTranslation->addFormat($documentFormat);
            }

            $document->addTranslation($documentTranslation);
            $documents[$packageKey] = $document;
        }
    }

    /**
     * Returns the supported documentation rendering formats.
     *
     * @return array
     */
    protected function getSupportedFormats()
    {
        if (!\Causal\Sphinx\Utility\SphinxBuilder::isReady()) {
            return array();
        }
        $formats = array('html', 'json');

        $configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('sphinx');
        switch ($configuration['pdf_builder']) {
            case 'pdflatex':
                $renderPdf = \TYPO3\CMS\Core\Utility\CommandUtility::getCommand('pdflatex') !== '';
                break;
            case 'rst2pdf':
                $renderPdf = true;
                break;
            default:
                $renderPdf = false;
                break;
        }
        if ($renderPdf) {
            $formats[] = 'pdf';
        }

        return $formats;
    }

    /**
     * Returns a rendering link.
     *
     * @param string $reference
     * @param string $format The format of the documentation ("html", "json" or "pdf")
     * @param string $referenceType
     * @return string
     */
    protected function getRenderLink($reference, $format, $referenceType = 'EXT')
    {
        /** @var \TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder $uriBuilder */
        $uriBuilder = $this->objectManager->get(\TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder::class);
        $request = $this->objectManager->get(\TYPO3\CMS\Extbase\Mvc\Web\Request::class);
        $uriBuilder->setRequest($request)->setArguments(array('M' => 'help_SphinxDocumentation'));

        $link = $uriBuilder->uriFor(
            'index',
            array(
                'reference' => $referenceType . ':' . $reference,
                'layout' => $format,
                'force' => false,
            ),
            'Documentation',
            'sphinx',
            'help_sphinxdocumentation'
        );

        return $link;
    }

}
