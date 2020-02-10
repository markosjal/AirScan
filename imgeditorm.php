<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <title>2. Mobile</title>
        <link type="text/css" href="https://cdn.rawgit.com/nhnent/tui.color-picker/v2.0.0/dist/tui-color-picker.css" rel="stylesheet">
        <link type="text/css" href="css/service-mobile.css" rel="stylesheet">
    </head>
    <body>
        <!-- Image editor controls - top area -->
        <div class="header">
            <div>
                <img class="logo" src="img/TOAST UI Component.png"> <span class="name">Image Editor</span>
            </div>
            <div class="menu">
                <span class="button">
                    <img src="img/openImage.png" style="margin-top: 5px;" />
                    <input type="file" accept="image/*" id="input-image-file">
                </span>
                <button class="button disabled" id="btn-undo"><img src="img/undo.png" /></button>
                <button class="button disabled" id="btn-redo"><img src="img/redo.png" /></button>
                <button class="button" id="btn-remove-active-object"><img src="img/remove.png" /></button>
                <button class="button" id="btn-download"><img src="img/download.png" /></button>
            </div>
        </div>
        <!-- Image editor area -->
        <div class="tui-image-editor"></div>
        <!-- Image editor controls - bottom area -->
        <div class="tui-image-editor-controls">
            <ul class="scrollable">
                <li class="menu-item">
                    <button class="menu-button" id="btn-crop">Crop</button>
                    <div class="submenu">
                        <button class="btn-prev">&lt;</button>
                        <ul class="scrollable">
                            <li class="menu-item"><button class="submenu-button" id="btn-apply-crop">Apply</button></li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <button class="menu-button">Orientation</button>
                    <div class="submenu">
                        <button class="btn-prev">&lt;</button>
                        <ul class="scrollable">
                            <li class="menu-item"><button class="submenu-button" id="btn-rotate-clockwise">Rotate +90</button></li>
                            <li class="menu-item"><button class="submenu-button" id="btn-rotate-counter-clockwise">Rotate -90</button></li>
                            <li class="menu-item"><button class="submenu-button" id="btn-flip-x">FilpX</button></li>
                            <li class="menu-item"><button class="submenu-button" id="btn-flip-y">FilpY</button></li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <button class="menu-button" id="btn-draw-line">Drawing</button>
                    <div class="submenu">
                        <button class="btn-prev">&lt;</button>
                        <ul class="scrollable">
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-free-drawing">Free<br>Drawing</button>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-line-drawing">Line<br>Drawing</button>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-size">Brush<br>Size</button>
                                <div class="hiddenmenu">
                                    <input id="input-brush-range" type="range" min="10" max="100" value="50" />
                                </div>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-text-color">Brush<br>Color</button>
                                <div class="hiddenmenu">
                                    <div id="tui-brush-color-picker"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <button class="menu-button" id="btn-draw-shape">Shape</button>
                    <div class="submenu">
                        <button class="btn-prev">&lt;</button>
                        <ul class="scrollable">
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-add-rect">Rectagle</button>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-add-square">Square</button>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-add-ellipse">Ellipse</button>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-add-circle">Circle</button>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-add-triangle">Triangle</button>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-stroke-size">Stroke<br>Size</button>
                                <div class="hiddenmenu">
                                    <input id="input-stroke-range" type="range" min="1" max="100" value="10" />
                                </div>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-shape-color">Color</button>
                                <div class="hiddenmenu">
                                    <div class="top">
                                        <label for="fill-color"><input type="radio" id="fill-color" name="select-color-type" value="fill" checked="checked" /> Fill</label>
                                        <label for="stroke-color"><input type="radio" id="stroke-color" name="select-color-type" value="stroke" /> Stroke</label>
                                        <label for="input-check-transparent"><input type="checkbox" id="input-check-transparent">Transparent</label>
                                    </div>
                                    <div id="tui-shape-color-picker"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <button class="menu-button">Icon</button>
                    <div class="submenu">
                        <button class="btn-prev">&lt;</button>
                        <ul class="scrollable">
                            <li class="menu-item"><button class="submenu-button" id="btn-add-arrow-icon">Arrow<br>Icon</button></li>
                            <li class="menu-item"><button class="submenu-button" id="btn-add-cancel-icon">Cancel<br>Icon</button></li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-icon-color">Color</button>
                                <div class="hiddenmenu">
                                    <div id="tui-icon-color-picker"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <button class="menu-button" id="btn-add-text">Text</button>
                    <div class="submenu">
                        <button class="btn-prev">&lt;</button>
                        <ul class="scrollable">
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-size">Size</button>
                                <div class="hiddenmenu">
                                    <input id="input-text-size-range" type="range" min="10" max="240" value="120">
                                </div>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-style">Style</button>
                                <div class="hiddenmenu">
                                    <button class="hiddenmenu-button btn-change-text-style" data-style-type="bold"><b>Bold</b></button>
                                    <button class="hiddenmenu-button btn-change-text-style" data-style-type="italic"><i>Italic</i></button>
                                    <button class="hiddenmenu-button btn-change-text-style" data-style-type="underline"><u>Underline</u></button>
                                </div>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-align">Align</button>
                                <div class="hiddenmenu">
                                    <button class="hiddenmenu-button btn-change-text-style" data-style-type="left">Left</button>
                                    <button class="hiddenmenu-button btn-change-text-style" data-style-type="center">Center</button>
                                    <button class="hiddenmenu-button btn-change-text-style" data-style-type="right">Right</button>
                                </div>
                            </li>
                            <li class="menu-item">
                                <button class="submenu-button" id="btn-change-text-color">Color</button>
                                <div class="hiddenmenu">
                                    <div id="tui-text-color-picker"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <p class="msg">Menu Scrolling <b>Left ⇔ Right</b></p>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.7/fabric.js"></script>
        <script type="text/javascript" src="https://uicdn.toast.com/tui.code-snippet/v1.5.0/tui-code-snippet.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/nhnent/tui.component.colorpicker/1.0.2/dist/colorpicker.min.js"></script>
        <script type="text/javascript" src="../dist/tui-image-editor.js"></script>
        <script src="js/service-mobile.js"></script>
    </body>
</html>
