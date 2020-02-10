<html>
<head>
<script src="javascript/code-snippet.min.js"></script>
<script src="javascript/jquery.min.js"></script>
<script src="javascript/fabric.min.js"></script>
<script src="javascript/image-editor.js"></script>
</head>
<body>


<div id="tui-image-editor"></div>
<script>
var ImageEditor = require('tui-image-editor');
var blackTheme = require('./js/theme/black-theme.js');
var locale_ru_RU = { // override default English locale to your custom
    'Crop': 'Обзрезать',
    'Delete-all': 'Удалить всё'
    // etc...
};
var instance = new ImageEditor(document.querySelector('#tui-image-editor'), {
     includeUI: {
         loadImage: {
             path: 'img/sampleImage.jpg',
             name: 'SampleImage'
         },
         locale: locale_ru_RU,
         theme: blackTheme, // or whiteTheme
         initMenu: 'filter',
         menuBarPosition: 'bottom'
     },
    cssMaxWidth: 700,
    cssMaxHeight: 500,
    selectionStyle: {
        cornerSize: 20,
        rotatingPointOffset: 70
    }
});
</script>
</body>
<html>
