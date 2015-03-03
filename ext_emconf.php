<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "sphinx".
 *
 * Auto generated 03-03-2015 17:22
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Sphinx Python Documentation Generator and Viewer',
	'description' => 'Installs a full-fledged Sphinx environment within your TYPO3 website. Builds and renders Sphinx/reStructuredText-based projects such as extension manuals, official reference guides or your own in-house documents as HTML/JSON/PDF either from TYPO3 Backend or from command-line, as you prefer. Features a reStructuredText editor with cross-reference browser and syntax highlighting.',
	'category' => 'module',
	'author' => 'Xavier Perseguers (Causal)',
	'author_company' => 'Causal Sàrl',
	'author_email' => 'xavier@causal.ch',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '2.2.1',
	'constraints' => array(
		'depends' => array(
			'php' => '5.3.3-5.6.99',
			'typo3' => '6.2.0-7.99.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
			'restdoc' => '1.4.0-0.0.0',
		),
	),
	'_md5_values_when_last_written' => 'a:308:{s:13:"composer.json";s:4:"3ce3";s:21:"ext_conf_template.txt";s:4:"728e";s:12:"ext_icon.png";s:4:"55d8";s:17:"ext_localconf.php";s:4:"6368";s:14:"ext_tables.php";s:4:"4f48";s:20:"class.ext_update.php";s:4:"8fd5";s:47:"Classes/Controller/AbstractActionController.php";s:4:"f872";s:37:"Classes/Controller/AjaxController.php";s:4:"2560";s:46:"Classes/Controller/DocumentationController.php";s:4:"d812";s:50:"Classes/Controller/InteractiveViewerController.php";s:4:"ac79";s:43:"Classes/Controller/RestEditorController.php";s:4:"567c";s:38:"Classes/Domain/Model/Documentation.php";s:4:"8e42";s:34:"Classes/Domain/Model/Extension.php";s:4:"e703";s:32:"Classes/Domain/Model/Project.php";s:4:"0b14";s:53:"Classes/Domain/Repository/DocumentationRepository.php";s:4:"b720";s:49:"Classes/Domain/Repository/ExtensionRepository.php";s:4:"177b";s:47:"Classes/Domain/Repository/ProjectRepository.php";s:4:"2438";s:28:"Classes/EM/Configuration.php";s:4:"932d";s:31:"Classes/Slots/CustomProject.php";s:4:"9008";s:36:"Classes/Slots/LatexPostProcessor.php";s:4:"af2b";s:37:"Classes/Slots/SphinxDocumentation.php";s:4:"d2aa";s:33:"Classes/Utility/Configuration.php";s:4:"d102";s:30:"Classes/Utility/GitUtility.php";s:4:"3d5a";s:31:"Classes/Utility/MiscUtility.php";s:4:"194d";s:39:"Classes/Utility/OpenOfficeConverter.php";s:4:"53be";s:25:"Classes/Utility/Setup.php";s:4:"5b83";s:33:"Classes/Utility/SphinxBuilder.php";s:4:"acf1";s:36:"Classes/Utility/SphinxQuickstart.php";s:4:"63de";s:38:"Classes/ViewHelpers/FormViewHelper.php";s:4:"4775";s:49:"Classes/ViewHelpers/IncludeMessagesViewHelper.php";s:4:"df7d";s:51:"Classes/ViewHelpers/ObjectsInvBrowserViewHelper.php";s:4:"62f1";s:45:"Classes/ViewHelpers/ProjectTreeViewHelper.php";s:4:"dc29";s:45:"Classes/ViewHelpers/Form/SelectViewHelper.php";s:4:"1a17";s:45:"Classes/ViewHelpers/Form/UploadViewHelper.php";s:4:"58b3";s:50:"Classes/ViewHelpers/IncludeJs/JQueryViewHelper.php";s:4:"b296";s:45:"Classes/ViewHelpers/Link/ActionViewHelper.php";s:4:"4f35";s:26:"Documentation/Includes.txt";s:4:"ef74";s:23:"Documentation/Index.rst";s:4:"caf7";s:23:"Documentation/Links.rst";s:4:"7560";s:26:"Documentation/Settings.yml";s:4:"3942";s:43:"Documentation/AdministratorManual/Index.rst";s:4:"4b39";s:53:"Documentation/AdministratorManual/ChangeLog/Index.rst";s:4:"c441";s:63:"Documentation/AdministratorManual/InstallingExtension/Index.rst";s:4:"9f79";s:57:"Documentation/AdministratorManual/KnownProblems/Index.rst";s:4:"65c7";s:56:"Documentation/AdministratorManual/RenderingPdf/Index.rst";s:4:"dd54";s:71:"Documentation/AdministratorManual/RenderingPdf/InstallingLaTeXLinux.rst";s:4:"7018";s:73:"Documentation/AdministratorManual/RenderingPdf/InstallingLaTeXWindows.rst";s:4:"bf06";s:70:"Documentation/AdministratorManual/RenderingPdf/InstallingShareFont.rst";s:4:"4adf";s:56:"Documentation/AdministratorManual/WindowsSetup/Index.rst";s:4:"ec89";s:43:"Documentation/AdvancedUsersManual/Index.rst";s:4:"ffc2";s:62:"Documentation/AdvancedUsersManual/AdvancedCrossLinks/Index.rst";s:4:"4bfa";s:75:"Documentation/AdvancedUsersManual/AdvancedCrossLinks/prepare-objects-inv.sh";s:4:"4dc3";s:51:"Documentation/AdvancedUsersManual/Plugins/Index.rst";s:4:"6fd2";s:71:"Documentation/AdvancedUsersManual/RenderingPdf/CustomizingRendering.rst";s:4:"6631";s:56:"Documentation/AdvancedUsersManual/RenderingPdf/Index.rst";s:4:"e8ec";s:68:"Documentation/AdvancedUsersManual/RenderingPdf/IntroductionLaTeX.rst";s:4:"80a7";s:65:"Documentation/AdvancedUsersManual/RenderingPdf/LaTeXVsRst2pdf.rst";s:4:"af95";s:66:"Documentation/AdvancedUsersManual/UsingSphinxCommandLine/Index.rst";s:4:"d442";s:39:"Documentation/DeveloperManual/Index.rst";s:4:"29b4";s:65:"Documentation/DeveloperManual/SignalSlots/PostProcessingLaTeX.rst";s:4:"6a13";s:76:"Documentation/DeveloperManual/SignalSlots/RegisteringCustomDocumentation.rst";s:4:"ee54";s:37:"Documentation/Images/context-menu.png";s:4:"9c73";s:43:"Documentation/Images/convert-openoffice.png";s:4:"ae80";s:45:"Documentation/Images/custom_documentation.png";s:4:"fdda";s:34:"Documentation/Images/dashboard.png";s:4:"46c8";s:33:"Documentation/Images/download.png";s:4:"edff";s:39:"Documentation/Images/edit-me-github.png";s:4:"e84a";s:37:"Documentation/Images/edit_chapter.png";s:4:"777b";s:31:"Documentation/Images/em-pdf.png";s:4:"7619";s:35:"Documentation/Images/em-plugins.png";s:4:"0642";s:42:"Documentation/Images/em-sphinx-version.png";s:4:"27da";s:37:"Documentation/Images/em_configure.png";s:4:"8f2c";s:34:"Documentation/Images/em_update.png";s:4:"917d";s:50:"Documentation/Images/environment_check_windows.png";s:4:"8dd3";s:46:"Documentation/Images/environment_variables.png";s:4:"2910";s:31:"Documentation/Images/finger.png";s:4:"f98d";s:38:"Documentation/Images/import_sphinx.png";s:4:"7781";s:41:"Documentation/Images/kickstart-sphinx.png";s:4:"ef0b";s:35:"Documentation/Images/LaTeX_logo.png";s:4:"25b9";s:41:"Documentation/Images/libarchive_setup.png";s:4:"aeb9";s:47:"Documentation/Images/manage-custom-projects.png";s:4:"775f";s:40:"Documentation/Images/miktex_onthefly.png";s:4:"7c3e";s:37:"Documentation/Images/miktex_setup.png";s:4:"64e1";s:36:"Documentation/Images/msvcr100dll.png";s:4:"49a2";s:34:"Documentation/Images/pdf_latex.png";s:4:"f3a4";s:36:"Documentation/Images/pdf_rst2pdf.png";s:4:"f15e";s:37:"Documentation/Images/python_setup.png";s:4:"097b";s:43:"Documentation/Images/references-browser.png";s:4:"7c3f";s:37:"Documentation/Images/render-again.png";s:4:"fb86";s:35:"Documentation/Images/render_pdf.png";s:4:"1428";s:36:"Documentation/Images/rest-editor.png";s:4:"7866";s:37:"Documentation/Images/save_compile.png";s:4:"4417";s:37:"Documentation/Images/section_help.png";s:4:"1370";s:35:"Documentation/Images/share_font.png";s:4:"8e9b";s:50:"Documentation/Images/sphinxcontrib-googlechart.png";s:4:"9ea8";s:49:"Documentation/Images/sphinxcontrib-googlemaps.png";s:4:"4ec1";s:44:"Documentation/Images/sphinxcontrib-slide.png";s:4:"b860";s:46:"Documentation/Images/sphinxcontrib-youtube.png";s:4:"5393";s:41:"Documentation/Images/system_variables.png";s:4:"b73b";s:48:"Documentation/Images/translated-uri-segments.png";s:4:"bbfa";s:36:"Documentation/Images/unzip_setup.png";s:4:"9a08";s:38:"Documentation/Images/update_script.png";s:4:"d46c";s:31:"Documentation/Images/viewer.png";s:4:"ce54";s:48:"Documentation/Images/viewer_choose_extension.png";s:4:"265e";s:43:"Documentation/Images/wizard-new-project.png";s:4:"93b0";s:36:"Documentation/Introduction/Index.rst";s:4:"fb8d";s:42:"Documentation/Localization.fr_FR/Index.rst";s:4:"f274";s:42:"Documentation/Localization.fr_FR/Links.rst";s:4:"c18d";s:45:"Documentation/Localization.fr_FR/Settings.yml";s:4:"a9a4";s:62:"Documentation/Localization.fr_FR/AdministratorManual/Index.rst";s:4:"c8d1";s:72:"Documentation/Localization.fr_FR/AdministratorManual/ChangeLog/Index.rst";s:4:"631c";s:82:"Documentation/Localization.fr_FR/AdministratorManual/InstallingExtension/Index.rst";s:4:"cd1b";s:76:"Documentation/Localization.fr_FR/AdministratorManual/KnownProblems/Index.rst";s:4:"088b";s:75:"Documentation/Localization.fr_FR/AdministratorManual/RenderingPdf/Index.rst";s:4:"5509";s:90:"Documentation/Localization.fr_FR/AdministratorManual/RenderingPdf/InstallingLaTeXLinux.rst";s:4:"a547";s:92:"Documentation/Localization.fr_FR/AdministratorManual/RenderingPdf/InstallingLaTeXWindows.rst";s:4:"6aa5";s:89:"Documentation/Localization.fr_FR/AdministratorManual/RenderingPdf/InstallingShareFont.rst";s:4:"cf58";s:75:"Documentation/Localization.fr_FR/AdministratorManual/WindowsSetup/Index.rst";s:4:"ccb1";s:62:"Documentation/Localization.fr_FR/AdvancedUsersManual/Index.rst";s:4:"c9c9";s:81:"Documentation/Localization.fr_FR/AdvancedUsersManual/AdvancedCrossLinks/Index.rst";s:4:"27db";s:70:"Documentation/Localization.fr_FR/AdvancedUsersManual/Plugins/Index.rst";s:4:"7d09";s:90:"Documentation/Localization.fr_FR/AdvancedUsersManual/RenderingPdf/CustomizingRendering.rst";s:4:"25d3";s:75:"Documentation/Localization.fr_FR/AdvancedUsersManual/RenderingPdf/Index.rst";s:4:"8f0f";s:87:"Documentation/Localization.fr_FR/AdvancedUsersManual/RenderingPdf/IntroductionLaTeX.rst";s:4:"deb8";s:84:"Documentation/Localization.fr_FR/AdvancedUsersManual/RenderingPdf/LaTeXVsRst2pdf.rst";s:4:"2c71";s:85:"Documentation/Localization.fr_FR/AdvancedUsersManual/UsingSphinxCommandLine/Index.rst";s:4:"f01f";s:58:"Documentation/Localization.fr_FR/DeveloperManual/Index.rst";s:4:"23b4";s:84:"Documentation/Localization.fr_FR/DeveloperManual/SignalSlots/PostProcessingLaTeX.rst";s:4:"fb87";s:95:"Documentation/Localization.fr_FR/DeveloperManual/SignalSlots/RegisteringCustomDocumentation.rst";s:4:"d97b";s:55:"Documentation/Localization.fr_FR/Introduction/Index.rst";s:4:"c31c";s:54:"Documentation/Localization.fr_FR/UsersManual/Index.rst";s:4:"5ffb";s:67:"Documentation/Localization.fr_FR/UsersManual/Requirements/Index.rst";s:4:"a74a";s:80:"Documentation/Localization.fr_FR/UsersManual/SphinxDocumentationViewer/Index.rst";s:4:"abed";s:63:"Documentation/Localization.fr_FR/UsersManual/ToDoList/Index.rst";s:4:"e2d2";s:56:"Documentation/Localization.fr_FR/WritersManual/Index.rst";s:4:"48d9";s:58:"Documentation/Localization.fr_FR/WritersManual/Targets.rst";s:4:"63f1";s:69:"Documentation/Localization.fr_FR/WritersManual/DocsTypo3Org/Index.rst";s:4:"b878";s:82:"Documentation/Localization.fr_FR/WritersManual/SphinxDocumentationEditor/Index.rst";s:4:"717a";s:67:"Documentation/Localization.fr_FR/WritersManual/SphinxRest/Index.rst";s:4:"a69e";s:35:"Documentation/UsersManual/Index.rst";s:4:"5565";s:48:"Documentation/UsersManual/Requirements/Index.rst";s:4:"29f4";s:61:"Documentation/UsersManual/SphinxDocumentationViewer/Index.rst";s:4:"3f86";s:44:"Documentation/UsersManual/ToDoList/Index.rst";s:4:"7dd7";s:37:"Documentation/WritersManual/Index.rst";s:4:"1a1e";s:39:"Documentation/WritersManual/Targets.rst";s:4:"76b7";s:50:"Documentation/WritersManual/DocsTypo3Org/Index.rst";s:4:"aa4d";s:63:"Documentation/WritersManual/SphinxDocumentationEditor/Index.rst";s:4:"ce69";s:48:"Documentation/WritersManual/SphinxRest/Index.rst";s:4:"e170";s:40:"Resources/Private/Language/locallang.xlf";s:4:"ac6f";s:43:"Resources/Private/Language/locallang_db.xlf";s:4:"67ba";s:58:"Resources/Private/Language/locallang_mod_documentation.xlf";s:4:"434d";s:38:"Resources/Private/Layouts/Default.html";s:4:"8a0c";s:59:"Resources/Private/Partials/Documentation/HeaderToolbar.html";s:4:"21d0";s:55:"Resources/Private/Partials/Documentation/HeaderTop.html";s:4:"ab45";s:65:"Resources/Private/Partials/Documentation/TabConvertExtension.html";s:4:"1158";s:55:"Resources/Private/Partials/Documentation/TabCustom.html";s:4:"807f";s:67:"Resources/Private/Partials/Documentation/TabKickstartExtension.html";s:4:"ea7e";s:64:"Resources/Private/Partials/Documentation/Table/ExtensionRow.html";s:4:"7aea";s:62:"Resources/Private/Partials/Documentation/Table/ProjectRow.html";s:4:"e7fb";s:32:"Resources/Private/Scss/main.scss";s:4:"3259";s:43:"Resources/Private/Scss/helpers/_mixins.scss";s:4:"1c41";s:38:"Resources/Private/Scss/page/_base.scss";s:4:"eb9a";s:43:"Resources/Private/Scss/page/_dashboard.scss";s:4:"5115";s:40:"Resources/Private/Scss/page/_header.scss";s:4:"96a6";s:47:"Resources/Private/Scss/page/_jquery.layout.scss";s:4:"9a98";s:52:"Resources/Private/Scss/page/_jquery.selectBoxIt.scss";s:4:"bcda";s:50:"Resources/Private/Scss/page/_jquery.treetable.scss";s:4:"76de";s:64:"Resources/Private/Scss/page/_jquery.treetable.theme.default.scss";s:4:"2922";s:54:"Resources/Private/Templates/Ajax/AddCustomProject.html";s:4:"5160";s:55:"Resources/Private/Templates/Ajax/EditCustomProject.html";s:4:"1d8a";s:56:"Resources/Private/Templates/Documentation/Dashboard.html";s:4:"9121";s:52:"Resources/Private/Templates/Documentation/Index.html";s:4:"aa56";s:53:"Resources/Private/Templates/Documentation/Render.html";s:4:"bd09";s:65:"Resources/Private/Templates/InteractiveViewer/MissingRestdoc.html";s:4:"a8c8";s:66:"Resources/Private/Templates/InteractiveViewer/OutdatedRestdoc.html";s:4:"8b16";s:57:"Resources/Private/Templates/InteractiveViewer/Render.html";s:4:"608a";s:71:"Resources/Private/Templates/Projects/BlankSeparateProject/Makefile.tmpl";s:4:"2a56";s:77:"Resources/Private/Templates/Projects/BlankSeparateProject/source/conf.py.tmpl";s:4:"a0b5";s:88:"Resources/Private/Templates/Projects/BlankSeparateProject/source/MasterDocument.rst.tmpl";s:4:"3e59";s:68:"Resources/Private/Templates/Projects/BlankSingleProject/conf.py.tmpl";s:4:"a0b5";s:69:"Resources/Private/Templates/Projects/BlankSingleProject/Makefile.tmpl";s:4:"64ff";s:79:"Resources/Private/Templates/Projects/BlankSingleProject/MasterDocument.rst.tmpl";s:4:"3e59";s:75:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/Settings.yml.tmpl";s:4:"98b6";s:76:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/conf.py.tmpl";s:4:"dfb8";s:77:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/make-html.bat";s:4:"6d1c";s:77:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/make.bat.tmpl";s:4:"22dc";s:77:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/Makefile.tmpl";s:4:"869f";s:90:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/_not_versioned/_.gitignore";s:4:"829c";s:65:"Resources/Private/Templates/Projects/TYPO3DocProject/Includes.txt";s:4:"6d5f";s:76:"Resources/Private/Templates/Projects/TYPO3DocProject/MasterDocument.rst.tmpl";s:4:"c355";s:70:"Resources/Private/Templates/Projects/TYPO3DocProject/Settings.yml.tmpl";s:4:"ae3a";s:82:"Resources/Private/Templates/Projects/TYPO3DocProject/AdministratorManual/Index.rst";s:4:"912c";s:83:"Resources/Private/Templates/Projects/TYPO3DocProject/Images/IntroductionPackage.png";s:4:"bd5d";s:100:"Resources/Private/Templates/Projects/TYPO3DocProject/Images/AdministratorManual/ExtensionManager.png";s:4:"47a4";s:86:"Resources/Private/Templates/Projects/TYPO3DocProject/Images/UserManual/BackendView.png";s:4:"7f27";s:75:"Resources/Private/Templates/Projects/TYPO3DocProject/Introduction/Index.rst";s:4:"ccbd";s:100:"Resources/Private/Templates/Projects/TYPO3DocProject/Localization.de_DE.tmpl/MasterDocument.rst.tmpl";s:4:"b280";s:83:"Resources/Private/Templates/Projects/TYPO3DocProject/Localization.de_DE.tmpl/README";s:4:"fe42";s:94:"Resources/Private/Templates/Projects/TYPO3DocProject/Localization.de_DE.tmpl/Settings.yml.tmpl";s:4:"c329";s:100:"Resources/Private/Templates/Projects/TYPO3DocProject/Localization.fr_FR.tmpl/MasterDocument.rst.tmpl";s:4:"19c1";s:83:"Resources/Private/Templates/Projects/TYPO3DocProject/Localization.fr_FR.tmpl/README";s:4:"1daf";s:94:"Resources/Private/Templates/Projects/TYPO3DocProject/Localization.fr_FR.tmpl/Settings.yml.tmpl";s:4:"d9a6";s:74:"Resources/Private/Templates/Projects/TYPO3DocProject/UsersManual/Index.rst";s:4:"63c4";s:71:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/conf.py.tmpl";s:4:"050f";s:72:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/make-html.bat";s:4:"6d1c";s:72:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/make.bat.tmpl";s:4:"22dc";s:72:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/Makefile.tmpl";s:4:"56d1";s:85:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/_not_versioned/_.gitignore";s:4:"829c";s:56:"Resources/Private/Templates/RestEditor/CreateDialog.html";s:4:"820c";s:48:"Resources/Private/Templates/RestEditor/Edit.html";s:4:"b7e0";s:55:"Resources/Private/Templates/RestEditor/ProjectTree.html";s:4:"db8f";s:56:"Resources/Private/Templates/RestEditor/RenameDialog.html";s:4:"e3c0";s:56:"Resources/Private/Templates/RestEditor/UploadDialog.html";s:4:"f018";s:35:"Resources/Public/Css/codemirror.css";s:4:"1c26";s:41:"Resources/Public/Css/jquery.clearable.css";s:4:"acab";s:29:"Resources/Public/Css/main.css";s:4:"faa0";s:33:"Resources/Public/Css/pygments.css";s:4:"3fe3";s:33:"Resources/Public/Css/typo3-7x.css";s:4:"38c5";s:73:"Resources/Public/Css/jquery-ui.smoothness/jquery-ui-1.10.4.custom.min.css";s:4:"1c20";s:69:"Resources/Public/Css/jquery-ui.smoothness/images/animated-overlay.gif";s:4:"2b91";s:79:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_flat_0_aaaaaa_40x100.png";s:4:"8a02";s:80:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_flat_75_ffffff_40x100.png";s:4:"b2c6";s:80:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_glass_55_fbf9ee_1x400.png";s:4:"edd5";s:80:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_glass_65_ffffff_1x400.png";s:4:"bec4";s:80:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_glass_75_dadada_1x400.png";s:4:"0c14";s:80:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png";s:4:"7fdf";s:80:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_glass_95_fef1ec_1x400.png";s:4:"c09f";s:89:"Resources/Public/Css/jquery-ui.smoothness/images/ui-bg_highlight-soft_75_cccccc_1x100.png";s:4:"9c0f";s:76:"Resources/Public/Css/jquery-ui.smoothness/images/ui-icons_222222_256x240.png";s:4:"a1b3";s:76:"Resources/Public/Css/jquery-ui.smoothness/images/ui-icons_2e83ff_256x240.png";s:4:"764c";s:76:"Resources/Public/Css/jquery-ui.smoothness/images/ui-icons_454545_256x240.png";s:4:"6b29";s:76:"Resources/Public/Css/jquery-ui.smoothness/images/ui-icons_888888_256x240.png";s:4:"302a";s:76:"Resources/Public/Css/jquery-ui.smoothness/images/ui-icons_cd0a0a_256x240.png";s:4:"5c78";s:37:"Resources/Public/Images/dashboard.png";s:4:"e0b6";s:40:"Resources/Public/Images/default_icon.png";s:4:"8a80";s:43:"Resources/Public/Images/default_icon@2x.png";s:4:"b41e";s:35:"Resources/Public/Images/docst3o.png";s:4:"f8dc";s:36:"Resources/Public/Images/download.png";s:4:"edff";s:41:"Resources/Public/Images/module-sphinx.png";s:4:"c13b";s:35:"Resources/Public/Images/warning.png";s:4:"ec6c";s:59:"Resources/Public/Images/jquery-treetable/bg-table-thead.png";s:4:"35fb";s:59:"Resources/Public/Images/jquery-treetable/collapse-light.png";s:4:"e97e";s:53:"Resources/Public/Images/jquery-treetable/collapse.png";s:4:"2ecd";s:57:"Resources/Public/Images/jquery-treetable/expand-light.png";s:4:"a48a";s:51:"Resources/Public/Images/jquery-treetable/expand.png";s:4:"2443";s:49:"Resources/Public/Images/jquery-treetable/file.png";s:4:"0da6";s:51:"Resources/Public/Images/jquery-treetable/folder.png";s:4:"fbd3";s:50:"Resources/Public/Images/jquery-treetable/image.png";s:4:"b18d";s:41:"Resources/Public/JavaScript/codemirror.js";s:4:"77f9";s:48:"Resources/Public/JavaScript/create-codemirror.sh";s:4:"5644";s:40:"Resources/Public/JavaScript/dashboard.js";s:4:"0bd0";s:37:"Resources/Public/JavaScript/editor.js";s:4:"862f";s:44:"Resources/Public/JavaScript/flashmessages.js";s:4:"ea26";s:55:"Resources/Public/JavaScript/jquery-migrate-1.2.1.min.js";s:4:"eb05";s:58:"Resources/Public/JavaScript/jquery-ui-1.10.4.custom.min.js";s:4:"3e9a";s:51:"Resources/Public/JavaScript/jquery.clearable.min.js";s:4:"54af";s:58:"Resources/Public/JavaScript/jquery.dataTables-1.9.4.min.js";s:4:"f1e6";s:46:"Resources/Public/JavaScript/jquery.form.min.js";s:4:"e74c";s:58:"Resources/Public/JavaScript/jquery.iframe-transport.min.js";s:4:"48f3";s:55:"Resources/Public/JavaScript/jquery.layout-latest.min.js";s:4:"e98a";s:53:"Resources/Public/JavaScript/jquery.selectBoxIt.min.js";s:4:"7c35";s:47:"Resources/Public/JavaScript/jquery.tools.min.js";s:4:"53da";s:57:"Resources/Public/JavaScript/jquery.treetable-3.1.0.min.js";s:4:"2391";s:56:"Resources/Public/JavaScript/jquery.ui-contextmenu.min.js";s:4:"1b79";s:39:"Resources/Public/JavaScript/spin.min.js";s:4:"649e";s:55:"Resources/Public/docs.typo3.org/css/t3_org_doc_main.css";s:4:"b54e";s:61:"Resources/Public/docs.typo3.org/css/t3_org_doc_main_alt_1.css";s:4:"6b12";s:59:"Resources/Public/docs.typo3.org/css/t3_to_be_integrated.css";s:4:"db4f";s:58:"Resources/Public/docs.typo3.org/i/arrow-r-888888-17x17.png";s:4:"712e";s:52:"Resources/Public/docs.typo3.org/js/docstypo3org-1.js";s:4:"ce22";s:52:"Resources/Public/docs.typo3.org/js/docstypo3org-2.js";s:4:"eba9";s:53:"Resources/Public/docs.typo3.org/t3extras/css/grid.css";s:4:"2c21";s:51:"Resources/Public/docs.typo3.org/t3extras/css/ie.css";s:4:"3811";s:52:"Resources/Public/docs.typo3.org/t3extras/css/ie7.css";s:4:"c4b3";s:52:"Resources/Public/docs.typo3.org/t3extras/css/ie8.css";s:4:"67aa";s:53:"Resources/Public/docs.typo3.org/t3extras/css/main.css";s:4:"462b";s:54:"Resources/Public/docs.typo3.org/t3extras/css/reset.css";s:4:"9088";s:54:"Resources/Public/docs.typo3.org/t3extras/css/share.css";s:4:"ba11";s:69:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.eot";s:4:"8c37";s:69:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.svg";s:4:"d80b";s:69:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.ttf";s:4:"2199";s:70:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.woff";s:4:"ab6f";s:71:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.eot";s:4:"d209";s:71:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.svg";s:4:"b6a5";s:71:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.ttf";s:4:"298c";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.woff";s:4:"3f06";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.eot";s:4:"a366";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.svg";s:4:"4e5d";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.ttf";s:4:"3a9a";s:73:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.woff";s:4:"b60d";s:55:"Resources/Public/docs.typo3.org/t3extras/fonts/share.js";s:4:"4950";s:51:"Resources/Public/docs.typo3.org/t3extras/fonts/TODO";s:4:"4844";s:57:"Resources/Public/docs.typo3.org/t3extras/i/blockquote.png";s:4:"66c6";s:55:"Resources/Public/docs.typo3.org/t3extras/i/i-arrows.png";s:4:"cacf";s:56:"Resources/Public/docs.typo3.org/t3extras/i/nav-aside.png";s:4:"2431";s:54:"Resources/Public/docs.typo3.org/t3extras/i/nav-sub.png";s:4:"c9d8";s:50:"Resources/Public/docs.typo3.org/t3extras/i/pre.png";s:4:"b6a6";s:56:"Resources/Public/docs.typo3.org/t3extras/i/s-buttons.png";s:4:"e2ee";s:58:"Resources/Public/docs.typo3.org/t3extras/i/shadow-page.jpg";s:4:"4957";s:58:"Resources/Public/docs.typo3.org/t3extras/i/shadow-site.png";s:4:"7390";s:57:"Resources/Public/docs.typo3.org/t3extras/i/typo3-logo.png";s:4:"f048";s:52:"Resources/Public/docs.typo3.org/t3extras/js/cufon.js";s:4:"7e47";s:55:"Resources/Public/docs.typo3.org/t3extras/js/jcookies.js";s:4:"4667";s:60:"Resources/Public/docs.typo3.org/t3extras/js/jquery.easing.js";s:4:"5d14";s:51:"Resources/Public/docs.typo3.org/t3extras/js/main.js";s:4:"e7d5";s:44:"Tests/Functional/Utility/MiscUtilityTest.php";s:4:"3fe4";s:40:"Tests/Unit/Utility/ConfigurationTest.php";s:4:"a7b7";s:38:"Tests/Unit/Utility/MiscUtilityTest.php";s:4:"d002";}',
	'suggests' => array(
	),
);

?>