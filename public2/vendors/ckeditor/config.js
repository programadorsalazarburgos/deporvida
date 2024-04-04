/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */


CKEDITOR.editorConfig = function( config ) {
 config.enterMode = CKEDITOR.ENTER_BR // pressing the ENTER KEY input <br/>
 config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER KEYS input <p>
config.autoParagraph = false;
config.ignoreEmptyParagraph = false;
config.entities = false;
config.fillEmptyBlocks = false;
config.tabSpaces = 0;
config.basicEntities = false;

};

