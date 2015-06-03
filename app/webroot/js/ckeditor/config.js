/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
   config.filebrowserBrowseUrl = '/ticksol-pms/js/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = '/ticksol-pms/js/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = '/ticksol-pms/js/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = '/ticksol-pms/js/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = '/ticksol-pms/js/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = '/ticksol-pms/js/kcfinder/upload.php?type=flash';
};
