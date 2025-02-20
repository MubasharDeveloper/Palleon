<!DOCTYPE html>
<html lang="en-US">
<!-- HEAD -->

<head>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    var getTheme = localStorage.getItem("theme");
    if (getTheme) {
        var themeCss = document.getElementById("theme-css");
        themeCss.setAttribute("href", "css/" + getTheme + ".css");
        
        var themeSwitcher = document.getElementById("theme-switcher");
        themeSwitcher.innerHTML = getTheme === "light" 
            ? '<span class="material-icons">nightlight</span>' 
            : '<span class="material-icons">wb_sunny</span>';

            themeSwitcher.classList = getTheme;
    }
});

  </script>
  <title>Palleon Motion - Animated GIF and Video Maker</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="title" content="Pmotion - Animated GIF and Video Maker">
  <meta name="description" content="Create animated videos with Pmotion, a motion graphics editor with keyframing, filters, text animations, and more...">
  <link rel="shortcut icon" href="{{asset('assets/favicon.ico')}}" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/plugins.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link id="theme-css" href="{{asset('css/light.css')}}" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- <link id="theme-css" href="css/light.css" rel="stylesheet" type="text/css"> -->
</head>
<!-- HEAD END -->
<!-- BODY -->
<body id="pmotion" draggable="false" class="loading">
  <!-- Page Loader START -->
  <div id="main-loader" class="loader-wrap">
    <div class="loader-inner">
        <div class="loader"></div>
    </div>
  </div>
  <!-- Page Loader END -->
  <!-- TOOLBAR -->
  <!-- <div id="toolbar" class="noselect toolbar-for-web">
    <div id="logo">
      <a href="#">
        <img src="{{asset('assets/logo.png')}}" alt="Palleon Motion">
      </a>
    </div>
    <div id="tool-wrap">
      <div id="object-settings-select" class="tool tool-active" data-id="object-settings">
        <span class="material-icons">tune</span>
        <p>Settings</p>
      </div>
      <div id="layer-select" class="tool" data-id="layer-panel">
        <span class="material-icons">layers</span>
        <p>Layers</p>
      </div>
      <div id="project-tool-select" class="tool" data-id="project-tool">
        <span class="material-icons">perm_media</span>
        <p>Templates</p>
      </div>
      <div id="upload-tool-select" class="tool" data-id="upload-tool">
        <span class="material-icons">cloud_upload</span>
        <p>Uploads</p>
      </div>
      <div id="text-tool-select" class="tool" data-id="text-tool">
        <span class="material-icons">title</span>
        <p>Text</p>
      </div>
      <div id="shape-tool-select" class="tool" data-id="shape-tool">
        <span class="material-icons">interests</span>
        <p>Objects</p>
      </div>
      <div id="image-tool-select" class="tool" data-id="image-tool">
        <span class="material-icons">add_photo_alternate</span>
        <p>Images</p>
      </div>
      <div id="video-tool-select" class="tool" data-id="video-tool">
        <span class="material-icons">videocam</span>
        <p>Videos</p>
      </div>
      <div id="audio-tool-select" class="tool" data-id="audio-tool">
        <span class="material-icons">queue_music</span>
        <p>Audio</p>
      </div>
      <div id="qrcode-tool-select" class="tool" data-id="qrcode-tool">
        <span class="material-icons">qr_code</span>
        <p>QR CODE</p>
      </div>
    </div>
  </div> -->
  <!-- TOOLBAR END -->
  <!-- BROWSER -->

  


  <div id="browser" class="scrollingPanel browser-position-cover">
    <div id="browser-container">
      <!-- OBJECT SETTINGS -->
      <div id="object-settings">
        <div class="tool-content">
          <p class="property-title">Settings</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div id="properties">
            <div id="properties-overlay">
              <button id="crop-selection" type="button" class="btn btn-full primary"> <span class="material-icons">transform</span>Click To Crop Image</button>
            </div>
            <div id="object-specific">
              <!-- DON'T REMOVE -->
              <input id="temp-color" type="hidden" class="form-field colorpicker" autocomplete="off" value="#fff">  
            </div>
          </div>
        </div>
      </div>
      <!-- PROJECTS TOOL -->
      <div id="project-tool" class="d-none">
        <div class="tool-content">
          <p class="property-title">Templates</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div class="nav-tab-wrap">
            <div class="nav-tabs">
              <div class="nav-tab nav-tab-active" data-target="project-library">
                Template Library
              </div>
              <div class="nav-tab" data-target="my-templates">
                My Templates
              </div>
            </div>
            <div id="project-library" class="nav-tab-content">
              <div id="template-library" >

                @foreach ($categories as $category)
                    
                <div class="category">
                  <button class="toggle-btn">
                    {{$category->category_name}} <span class="arrow">&#x25BC;</span>
                  </button>
                  <div class="template-container css-grid" >
                    @foreach($data as $template)
                    <div id="template{{$template['name']}}" class="image-grid-item" data-template="{{$template['json']}}" title="Template {{$template['name']}}">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{$template['image']}}" alt="" draggable="false" />
                      </div>
                    </div>
                    @endforeach
                    {{-- <div id="template2" class="image-grid-item" data-template="files/templates/2.json" title="Template 2">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/2.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template3" class="image-grid-item" data-template="files/templates/3.json" title="Template 3">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/3.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template4" class="image-grid-item" data-template="files/templates/4.json" title="Template 4">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/4.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template5" class="image-grid-item" data-template="files/templates/5.json" title="Template 5">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/5.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template6" class="image-grid-item" data-template="files/templates/6.json" title="Template 6">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/6.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template7" class="image-grid-item" data-template="files/templates/7.json" title="Template 7">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/7.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template8" class="image-grid-item" data-template="files/templates/8.json" title="Template 8">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/8.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template9" class="image-grid-item" data-template="files/templates/9.json" title="Template 9">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/9.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template10" class="image-grid-item" data-template="files/templates/10.json" title="Template 10">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/10.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template11" class="image-grid-item" data-template="files/templates/11.json" title="Template 11">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/11.png')}}" alt="" draggable="false" />
                      </div>
                    </div>
                    <div id="template12" class="image-grid-item" data-template="files/templates/12.json" title="Template 12">
                      <div class="img-wrap">
                        <div class="img-loader"></div>
                        <img class="lazy" src="{{asset('files/templates/12.png')}}" alt="" draggable="false" />
                      </div>
                    </div> --}}
                  </div>
                </div>
                @endforeach
                
                
                {{-- <div class="image-grid-item" data-template="files/templates/5.json" title="Template 5">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/5.png')}}" alt="" draggable="false" />
                  </div>
                </div>
                <div class="image-grid-item" data-template="files/templates/6.json" title="Template 6">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/6.png')}}" alt="" draggable="false" />
                  </div>
                </div>
                <div class="image-grid-item" data-template="files/templates/7.json" title="Template 7">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/7.png')}}" alt="" draggable="false" />
                  </div>
                </div>
                <div class="image-grid-item" data-template="files/templates/8.json" title="Template 8">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/8.png')}}" alt="" draggable="false" />
                  </div>
                </div>
                <div class="image-grid-item" data-template="files/templates/9.json" title="Template 9">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/9.png')}}" alt="" draggable="false" />
                  </div>
                </div>
                <div class="image-grid-item" data-template="files/templates/10.json" title="Template 10">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/10.png')}}" alt="" draggable="false" />
                  </div>
                </div>
                <div class="image-grid-item" data-template="files/templates/11.json" title="Template 11">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/11.png')}}" alt="" draggable="false" />
                  </div>
                </div>
                <div class="image-grid-item" data-template="files/templates/12.json" title="Template 12">
                  <div class="img-wrap">
                    <div class="img-loader"></div>
                    <img class="lazy" src="{{asset('files/templates/12.png')}}" alt="" draggable="false" />
                  </div>
                </div> --}}
              </div>
            </div>


            <style>
              .category {
                margin: 10px 0;
              }

              .toggle-btn {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px 15px;
                font-size: 16px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
              }

              .arrow {
                margin-left: 10px;
                font-size: 16px;
                transition: transform 0.2s;
              }

              .template-container {
                display: none;
                margin-top: 10px;
              }

              .template-container.show {
                display: grid;
              }

            </style>
            
            <div id="my-templates" class="nav-tab-content d-none">
              <div class="project-menu-btns">
                <button type="button" id="import-project" class="btn">Import</button>
                <button type="button" id="export-project" class="btn">Export</button>
                <button type="button" id="save-project" class="btn primary">Save</button>
              </div>
              <div id="projects-output"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- UPLOAD TOOL -->
      <div id="upload-tool" class="d-none">
        <div class="tool-content">
          <p class="property-title">Uploads</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div class="assets-buttons">
            <button id="upload-button" type="button" class="btn primary">
              <span class="material-icons">file_upload</span>
              Upload media
            </button>
            <button id="delete-assets-button" type="button" class="btn danger">
              <span class="material-icons">delete_forever</span>
            </button>
          </div>
          <div id="upload-tabs">
            <div id="images-tab" class="upload-tab upload-tab-active">
              Images
            </div>
            <div id="videos-tab" class="upload-tab">
              Videos
            </div>
          </div>
          <div id="uploaded-images">
            <div id="uploaded-images-grid" class="css-grid"></div>
          </div>
          <div id="uploaded-videos" class="d-none">
            <div id="uploaded-videos-grid" class="css-grid"></div>
          </div>
        </div>
      </div>
      <!-- TEXT TOOL -->
      <div id="text-tool" class="d-none">
        <div class="tool-content">
          <p class="property-title">Text</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div class="shapes-cont">
            <p class="row-title">Basic text</p>
            <div id="heading-text" data-font="Roboto" class="add-text noselect">
              Add a heading
            </div>
            <div id="subheading-text" data-font="Roboto" class="add-text noselect">
              Add a subheading
            </div>
            <div id="body-text" data-font="Roboto" class="add-text noselect">
              Add body text
            </div>
            <p class="row-title">Animated</p>
            <div class="animated-text-grid">
              <div class="animated-text-item noselect" data-id="fade in">
                <img draggable="false" class="noselect" src="{{asset('assets/fade-in.svg')}}">
                <div>Fade In</div>
              </div>
              <div class="animated-text-item noselect" data-id="typewriter">
                <img draggable="false" class="noselect" src="{{asset('assets/typewriter.svg')}}">
                <div>Typewriter</div>
              </div>
              <div class="animated-text-item noselect" data-id="slide top">
                <img draggable="false" class="noselect" src="{{asset('assets/slide-top.svg')}}">
                <div>Slide Top</div>
              </div>
              <div class="animated-text-item noselect" data-id="slide bottom">
                <img draggable="false" class="noselect" src="{{asset('assets/slide-bottom.svg')}}">
                <div>Slide Bottom</div>
              </div>
              <div class="animated-text-item noselect" data-id="slide left">
                <img draggable="false" class="noselect" src="{{asset('assets/slide-left.svg')}}">
                <div>Slide Left</div>
              </div>
              <div class="animated-text-item noselect" data-id="slide right">
                <img draggable="false" class="noselect" src="{{asset('assets/slide-right.svg')}}">
                <div>Slide Right</div>
              </div>
              <div class="animated-text-item noselect" data-id="scale">
                <img draggable="false" class="noselect" src="{{asset('assets/scale.svg')}}">
                <div>Scale</div>
              </div>
              <div class="animated-text-item noselect" data-id="shrink">
                <img draggable="false" class="noselect" src="{{asset('assets/shrink.svg')}}">
                <div>Shrink</div>
              </div>
            </div>
            <p class="row-title">Sans Serif</p>
            <div class="add-text noselect" data-font="Roboto" style="font-family: Roboto, sans-serif">
              Roboto
            </div>
            <div class="add-text noselect" data-font="Montserrat"
              style="font-family: Montserrat, sans-serif">
              Montserrat
            </div>
            <div class="add-text noselect" data-font="Poppins" style="font-family: Poppins, sans-serif">
              Poppins
            </div>
            <p class="row-title">Serif</p>
            <div class="add-text noselect" data-font="Playfair Display"
              style="font-family: Playfair Display">
              Playfair Display
            </div>
            <div class="add-text noselect" data-font="Merriweather" style="font-family: Merriweather">
              Merriweather
            </div>
            <div class="add-text noselect" data-font="IBM Plex Serif" style="font-family: IBM Plex Serif">
              IBM Plex Serif
            </div>
            <p class="row-title">Monospace</p>
            <div class="add-text noselect" data-font="Roboto Mono" style="font-family: Roboto Mono">
              Roboto Mono
            </div>
            <div class="add-text noselect" data-font="Inconsolata" style="font-family: Inconsolata">
              Inconsolata
            </div>
            <div class="add-text noselect" data-font="Source Code Pro"
              style="font-family: Source Code Pro">
              Source Code Pro
            </div>
            <p class="row-title">Handwriting</p>
            <div class="add-text noselect" data-font="Dancing Script" style="font-family: Dancing Script">
              Dancing Script
            </div>
            <div class="add-text noselect" data-font="Pacifico" style="font-family: Pacifico">
              Pacifico
            </div>
            <div class="add-text noselect" data-font="Indie Flower" style="font-family: Indie Flower">
              Indie Flower
            </div>
            <p class="row-title">Display</p>
            <div class="add-text noselect" data-font="Lobster" style="font-family: Lobster">
              Lobster
            </div>
            <div class="add-text noselect" data-font="Bebas Neue" style="font-family: Bebas Neue">
              Bebas Neue
            </div>
            <div class="add-text noselect" data-font="Titan One" style="font-family: Titan One">
              Titan One
            </div>
          </div>
        </div>
      </div>
      <!-- OBJECTS TOOL -->
      <div id="shape-tool" class="d-none">
        <div class="tool-content">
          <p class="property-title">Objects</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div class="shapes-cont">
            <!-- Shapes -->
            <p class="row-title">Shapes</p>
            <div id="shapes-gallery-row" class="gallery-row">
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/1.svg')}}" data-file="{{asset('files/shapes/1.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/2.svg')}}" data-file="{{asset('files/shapes/2.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/3.svg')}}" data-file="{{asset('files/shapes/3.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/4.svg')}}" data-file="{{asset('files/shapes/4.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/5.svg')}}" data-file="{{asset('files/shapes/5.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/6.svg')}}" data-file="{{asset('files/shapes/6.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/7.svg')}}" data-file="{{asset('files/shapes/7.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/8.svg')}}" data-file="{{asset('files/shapes/8.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/9.svg')}}" data-file="{{asset('files/shapes/9.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/10.svg')}}" data-file="{{asset('files/shapes/10.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/11.svg')}}" data-file="{{asset('files/shapes/11.svg')}}" />
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/shapes/12.svg')}}" data-file="{{asset('files/shapes/12.svg')}}" />
              </div>
            </div>
            <button type="button" class="btn btn-full object-more" data-folder="{{asset('files/shapes/')}}" data-offset="12" data-count="140">Load More</button>
            <!-- Emojis -->
            <p class="row-title">Emojis</p>
            <div class="gallery-row">
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/1.svg')}}" data-file="{{asset('files/emojis/1.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/2.svg')}}" data-file="{{asset('files/emojis/2.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/3.svg')}}" data-file="{{asset('files/emojis/3.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/4.svg')}}" data-file="{{asset('files/emojis/4.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/5.svg')}}" data-file="{{asset('files/emojis/5.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/6.svg')}}" data-file="{{asset('files/emojis/6.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/7.svg')}}" data-file="{{asset('files/emojis/7.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/8.svg')}}" data-file="{{asset('files/emojis/8.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/9.svg')}}" data-file="{{asset('files/emojis/9.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/10.svg')}}" data-file="{{asset('files/emojis/10.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/11.svg')}}" data-file="{{asset('files/emojis/11.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/emojis/12.svg')}}" data-file="{{asset('files/emojis/12.svg')}}"/>
              </div>
            </div>
            <button type="button" class="btn btn-full object-more" data-folder="{{asset('files/emojis/')}}" data-offset="12" data-count="152">Load More</button>
            <!-- Stickers -->
            <p class="row-title">Others</p>
            <div class="gallery-row">
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/1.svg')}}" data-file="{{asset('files/others/1.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/2.svg')}}" data-file="{{asset('files/others/2.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/3.svg')}}" data-file="{{asset('files/others/3.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/4.svg')}}" data-file="{{asset('files/others/4.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/5.svg')}}" data-file="{{asset('files/others/5.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/6.svg')}}" data-file="{{asset('files/others/6.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/7.svg')}}" data-file="{{asset('files/others/7.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/8.svg')}}" data-file="{{asset('files/others/8.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/9.svg')}}" data-file="{{asset('files/others/9.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/10.svg')}}" data-file="{{asset('files/others/10.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/11.svg')}}" data-file="{{asset('files/others/11.svg')}}"/>
              </div>
              <div class="grid-item">
                <img class="object-svg" draggable="false" src="{{asset('files/others/12.svg')}}" data-file="{{asset('files/others/12.svg')}}"/>
              </div>
            </div>
            <button type="button" class="btn btn-full object-more" data-folder="{{asset('files/others/')}}" data-offset="12" data-count="48">Load More</button>
          </div>
        </div>
      </div>
      <!-- IMAGE TOOL -->
      <div id="image-tool" class="d-none">
        <div class="tool-content">
          <p class="property-title">Images</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div class="nav-tabs-wrap">
            <div class="nav-tabs">
              <div class="nav-tab nav-tab-active" data-target="pixabay-images">
                Pixabay
              </div>
              <div class="nav-tab" data-target="pexels-images">
                Pexels
              </div>
            </div>
            <div id="pixabay-images" class="nav-tab-content">
              <div class="browser-wrap">
                <div class="browser-search-box">
                  <input id="pixabay-img-search" class="form-field" autocomplete="off" placeholder="Enter a keyword...">
                  <span class="material-icons delete-search">clear</span>
                  <button id="pixabay-img-search-btn" type="button" class="btn primary">
                    <span class="material-icons">search</span>
                  </button>
                </div>
                <div id="pixabay-search-options" class="d-none">
                  <select id="pixabay-orientation" class="custom-select" autocomplete="off">
                      <option value="" selected>All Orientations</option>
                      <option value="horizontal">Horizontal</option>
                      <option value="vertical">Vertical</option>
                  </select>
                  <select id="pixabay-color" class="custom-select" autocomplete="off">
                      <option value="" selected>All Colors</option>
                      <option value="white">White</option>
                      <option value="black">Black</option>
                      <option value="gray">Gray</option>
                      <option value="grayscale">Grayscale</option>
                      <option value="brown">Brown</option>
                      <option value="blue">Blue</option>
                      <option value="turquoise">Turquoise</option>
                      <option value="red">Red</option>
                      <option value="lilac">Lilac</option>
                      <option value="pink">Pink</option>
                      <option value="orange">Orange</option>
                      <option value="yellow">Yellow</option>
                      <option value="green">Green</option>
                  </select>
                  <select id="pixabay-category" class="custom-select" autocomplete="off">
                      <option value="" selected>All Categories</option>
                      <option value="backgrounds">Backgrounds</option>
                      <option value="fashion">Fashion</option>
                      <option value="nature">Nature</option>
                      <option value="science">Science</option>
                      <option value="education">Education</option>
                      <option value="feelings">Feelings</option>
                      <option value="health">Health</option>
                      <option value="people">People</option>
                      <option value="religion">Religion</option>
                      <option value="places">Places</option>
                      <option value="animals">Animals</option>
                      <option value="industry">Industry</option>
                      <option value="computer">Computer</option>
                      <option value="food">Food</option>
                      <option value="sports">Sports</option>
                      <option value="transportation">Transportation</option>
                      <option value="travel">Travel</option>
                      <option value="buildings">Buildings</option>
                      <option value="business">Business</option>
                      <option value="music">Music</option>
                  </select>
                </div>
                <div class="stock-settings-toggle">
                  <div id="pixabay-settings-toggle">More Settings <span class="material-icons">expand_more</span></div>
                </div>
                <div id="pixabay-img-output"></div>
                <div class="notice">Photos provided by <a href="https://pixabay.com/" target="_blank">Pixabay</a>.</div>
              </div>
            </div>
            <div id="pexels-images" class="nav-tab-content d-none">
              <div class="browser-wrap">
                <div class="browser-search-box">
                  <input id="pexels-img-search" class="form-field" autocomplete="off" placeholder="Enter a keyword...">
                  <span class="material-icons delete-search">clear</span>
                  <button id="pexels-img-search-btn" type="button" class="btn primary">
                    <span class="material-icons">search</span>
                  </button>
                </div>
                <div id="pexels-search-options" class="d-none">
                  <select id="pexels-orientation" class="custom-select" autocomplete="off" disabled>
                    <option value="" selected>All Orientations</option>
                    <option value="landscape">Landscape</option>
                    <option value="portrait">Portrait</option>
                    <option value="square">Square</option>
                </select>
                <select id="pexels-color" class="custom-select" autocomplete="off" disabled>
                    <option value="" selected>All Colors</option>
                    <option value="white">White</option>
                    <option value="black">Black</option>
                    <option value="gray">Gray</option>
                    <option value="brown">Brown</option>
                    <option value="blue">Blue</option>
                    <option value="turquoise">Turquoise</option>
                    <option value="red">Red</option>
                    <option value="violet">Violet</option>
                    <option value="pink">Pink</option>
                    <option value="orange">Orange</option>
                    <option value="yellow">Yellow</option>
                    <option value="green">Green</option>
                </select>
                </div>
                <div class="stock-settings-toggle">
                  <div id="pexels-settings-toggle">More Settings <span class="material-icons">expand_more</span></div>
                </div>
                <div id="pexels-img-output"></div>
                <div class="notice">Photos provided by <a href="https://pexels.com/" target="_blank">Pexels</a>.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- VIDEO TOOL -->
      <div id="video-tool" class="d-none">
        <div class="tool-content">
          <p class="property-title">Videos</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div class="nav-tabs-wrap">
            <div class="nav-tabs">
              <div class="nav-tab nav-tab-active" data-target="pixabay-videos">
                Pixabay
              </div>
              <div class="nav-tab" data-target="pexels-videos">
                Pexels
              </div>
            </div>
            <div id="pixabay-videos" class="nav-tab-content">
              <div class="browser-wrap">
                <div class="browser-search-box">
                  <input id="pixabay-video-search" class="form-field" autocomplete="off" placeholder="Enter a keyword...">
                  <span class="material-icons delete-search">clear</span>
                  <button id="pixabay-video-search-btn" type="button" class="btn primary">
                    <span class="material-icons">search</span>
                  </button>
                </div>
                <div id="pixabay-video-options" class="d-none">
                  <select id="pixabay-orientation-video" class="custom-select" autocomplete="off">
                      <option value="" selected>All Orientations</option>
                      <option value="horizontal">Horizontal</option>
                      <option value="vertical">Vertical</option>
                  </select>
                  <select id="pixabay-color-video" class="custom-select" autocomplete="off">
                      <option value="" selected>All Colors</option>
                      <option value="white">White</option>
                      <option value="black">Black</option>
                      <option value="gray">Gray</option>
                      <option value="grayscale">Grayscale</option>
                      <option value="brown">Brown</option>
                      <option value="blue">Blue</option>
                      <option value="turquoise">Turquoise</option>
                      <option value="red">Red</option>
                      <option value="lilac">Lilac</option>
                      <option value="pink">Pink</option>
                      <option value="orange">Orange</option>
                      <option value="yellow">Yellow</option>
                      <option value="green">Green</option>
                  </select>
                  <select id="pixabay-category-video" class="custom-select" autocomplete="off">
                      <option value="" selected>All Categories</option>
                      <option value="backgrounds">Backgrounds</option>
                      <option value="fashion">Fashion</option>
                      <option value="nature">Nature</option>
                      <option value="science">Science</option>
                      <option value="education">Education</option>
                      <option value="feelings">Feelings</option>
                      <option value="health">Health</option>
                      <option value="people">People</option>
                      <option value="religion">Religion</option>
                      <option value="places">Places</option>
                      <option value="animals">Animals</option>
                      <option value="industry">Industry</option>
                      <option value="computer">Computer</option>
                      <option value="food">Food</option>
                      <option value="sports">Sports</option>
                      <option value="transportation">Transportation</option>
                      <option value="travel">Travel</option>
                      <option value="buildings">Buildings</option>
                      <option value="business">Business</option>
                      <option value="music">Music</option>
                  </select>
                </div>
                <div class="stock-settings-toggle">
                  <div id="pixabay-videos-toggle">More Settings <span class="material-icons">expand_more</span></div>
                </div>
                <div id="pixabay-video-output"></div>
                <div class="notice">Videos provided by <a href="https://pixabay.com/" target="_blank">Pixabay</a>.</div>
              </div>
            </div>
            <div id="pexels-videos" class="nav-tab-content d-none">
              <div class="browser-wrap">
                <div class="browser-search-box">
                  <input id="pexels-video-search" class="form-field" autocomplete="off" placeholder="Enter a keyword...">
                  <span class="material-icons delete-search">clear</span>
                  <button id="pexels-video-search-btn" type="button" class="btn primary">
                    <span class="material-icons">search</span>
                  </button>
                </div>
                <div id="pexels-video-options" class="d-none">
                  <select id="pexels-video-orientation" class="custom-select" autocomplete="off" disabled>
                    <option value="" selected>All Orientations</option>
                    <option value="landscape">Landscape</option>
                    <option value="portrait">Portrait</option>
                    <option value="square">Square</option>
                </select>
                </div>
                <div class="stock-settings-toggle">
                  <div id="pexels-videos-toggle">More Settings <span class="material-icons">expand_more</span></div>
                </div>
                <div id="pexels-video-output"></div>
                <div class="notice">Videos provided by <a href="https://pexels.com/" target="_blank">Pexels</a>.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- AUDIO TOOL -->
      <div id="audio-tool" class="d-none">
        <div class="tool-content" class="audio-browser">
          <p class="property-title">Audio</p>
          <button id="audio-upload-button" type="button" class="btn btn-full primary">
            <span class="material-icons">file_upload</span>
            Upload audio
          </button>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div id="audio-list-parent">
    <div id="audio-list"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: "/api/audio-files",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let audioList = $("#audio-list");
                audioList.empty(); // Clear existing content

                data.forEach(audio => {
                    let audioItem = `
                        <div class="audio-item" data-file="${audio.url}">
                            <div class="audio-preview">
                                <span class="material-icons">play_arrow</span>
                            </div>
                            <img class="audio-thumb" src="${audio.thumbnail}" onerror="this.onerror=null; this.src='{{ asset('files/audio/the-default.png') }}';">
                            <div class="audio-info">
                                <div class="audio-info-title">${audio.name.replace(/-/g, ' ')}</div>
                            </div>
                        </div>
                    `;
                    audioList.append(audioItem);
                });
            },
            error: function () {
                alert("Failed to load audio files.");
            }
        });
    });
</script>


          <div class="landing-text">
            Browse millions of assets from Pixabay by
            <a href="https://pixabay.com/music/" target="_blank">
              clicking here.
            </a>
          </div>
        </div>
      </div>
      <!-- QR CODE TOOL -->
      <div id="qrcode-tool" class="d-none">
        <div class="tool-content">
          <p class="property-title">QR CODE</p>
          <span class="collapse material-icons d-none">
            keyboard_double_arrow_left
          </span>
          <div id="qrcode-settings">
            <div class="control-wrap">
                <label class="control-label">Preview</label>
                <div class="control">
                    <div id="qrcode-preview"></div>
                </div>
            </div>
            <hr />
            <div class="control-wrap">
                <label class="control-label">Text</label>
                <div class="control">
                    <input type="text" id="qrcode-text" class="form-field"
                        autocomplete="off" value="https://mysite.com" />
                </div>
            </div>
            <div class="control-wrap control-text-color">
                <label class="control-label">Fill Color</label>
                <div class="control">
                  <div class="colorpicker-box"></div>
                  <input id="qrcode-fill" class="form-field colorpicker app-colorpicker" autocomplete="off" value="#333333" readonly>
                </div>
            </div>
            <div class="control-wrap control-text-color">
                <label class="control-label">Background</label>
                <div class="control">
                  <div class="colorpicker-box"></div>
                  <input id="qrcode-back" class="form-field colorpicker app-colorpicker" autocomplete="off" value="#FFFFFF" readonly>
                </div>
            </div>
            <div class="control-wrap">
              <label class="control-label">Rounded Corners</label>
                <div class="control">
                    <input id="qrcode-rounded" type="range" min="0" max="100" value="0" step="1"
                        class="rangeslider" autocomplete="off">
                </div>
            </div>
            <hr />
            <div class="control-wrap">
                <label class="control-label">Label</label>
                <div class="control">
                    <input type="text" id="qrcode-label" class="form-field"
                        autocomplete="off" value="" />
                </div>
            </div>
            <div class="control-wrap control-text-color">
                <label class="control-label">Label Color</label>
                <div class="control">
                  <div class="colorpicker-box"></div>
                  <input id="qrcode-label-color" class="form-field colorpicker app-colorpicker" autocomplete="off" value="#333333" readonly>
                </div>
            </div>
            <div class="control-wrap">
                <label class="control-label slider-label">Label Size</label>
                <div class="control">
                    <input id="qrcode-label-size" type="range" min="0" max="100" value="30" step="1"
                        class="rangeslider" autocomplete="off">
                </div>
            </div>
            <div class="control-wrap">
                <label class="control-label slider-label">Position X</label>
                <div class="control">
                    <input id="qrcode-label-position-x" type="range" min="0" max="100" value="50"
                        step="1" class="rangeslider" autocomplete="off">
                </div>
            </div>
            <div class="control-wrap">
                <label class="control-label slider-label">Position Y</label>
                <div class="control">
                    <input id="qrcode-label-position-y" type="range" min="0" max="100" value="50"
                        step="1" class="rangeslider" autocomplete="off">
                </div>
            </div>
          </div>
          <hr />
          <button id="generate-qr-code" type="button" class="btn primary lg-btn btn-full">Generate QR Code</button>
        </div>
      </div>
    </div>
  </div>


  <!-- BROWSER END -->
  <!-- CANVAS AREA -->
  <div id="canvas-area">
    <!-- TOP CANVAS CONTROLS -->
    <div id="top-canvas-controls">
      <div id="clear-project">
        <span class="material-icons">delete</span>
        <span class="sm-hide">Clear</span>
      </div>
      <div id="undo">
        <span class="material-icons">undo</span>
        <span class="sm-hide">Undo</span>
      </div>
      <div id="redo">
        <span class="material-icons">redo</span>
        <span class="sm-hide">Redo</span>
      </div>
    </div>
    <!-- TOP CANVAS MENU -->
    <div id="top-canvas-menu">
      <div id="theme-switcher" class="light">
        <!-- <span class="material-icons">wb_sunny</span> -->
        <span class="material-icons">nightlight</span>
      </div>
      <!-- <div id="user-menu" class="user-menu">
        <div class="dropdown-wrap">
            <img alt="avatar" src='assets/avatar.png' /><span class="material-icons">arrow_drop_down</span>
            <div class="menu-menu-container">
                <ul class="dropdown">
                    <li><a href="#"><span class="material-icons">home</span>Home</a></li>
                    <li><a href="#"><span class="material-icons">article</span>Documentation</a>
                    </li>
                    <li><a href="#"><span class="material-icons">email</span>Contact Us</a></li>
                </ul>
            </div>
        </div>
      </div> -->
    </div>
    <!-- BOTTOM CANVAS -->
    <div id="bottom-canvas">
      <div id="zoom-options">
        <div title="Hand tool" id="hand-tool">
          <span class="material-icons">pan_tool</span>
        </div>
        <div id="zoom-level">
          <div class="zoom-item" data-zoom="out" title="Zoom out">
            <span class="material-icons">remove</span>
          </div>
          <div class="zoom-span">100%</div>
          <div class="zoom-item" data-zoom="in" title="Zoom in">
            <span class="material-icons">add</span>
          </div>
        </div>
      </div>
    </div>
    <!-- IMAGE LOADER -->
    <div id="load-image" class="load-media">
      <div class="load-media-wrap">
        <div class="canvas-loader"></div>
        <span>Loading image...</span>
      </div>
    </div>
    <!-- VIDEO LOADER -->
    <div id="load-video" class="load-media">
      <div class="load-media-wrap">
        <div class="canvas-loader"></div>
        <span>Loading video...</span>
      </div>
    </div>
    <!-- TEMPLATE LOADER -->
    <div id="load-template" class="load-media">
      <div class="load-media-wrap">
        <div class="canvas-loader"></div>
        <span>Loading template...</span>
      </div>
    </div>
    <!-- CANVAS -->
    <canvas id="canvas"></canvas>
    <!-- Canvas for recording -->
    <div class="d-none">
      <canvas id="canvasrecord"></canvas>
    </div>
  </div>
  <!-- CANVAS AREA END -->
  <!-- Timeline Handle -->
  <div id="timeline-handle" class="d-none"></div>
  <!-- BOTTOM AREA -->
  <div id="bottom-area" class="noselect layer-custom-class">
    <div id="keyframe-properties">
      <div id="easing">
        <p class="property-title">Keyframe easing</p>
        <select class="custom-select">
          <option value="linear">Linear</option>
          <option value="easeInQuad">Ease in</option>
          <option value="easeOutQuad">Ease out</option>
          <option value="easeInOutQuad">Ease in-out</option>
          <option value="easeOutInQuad">Ease out-in</option>
          <option value="easeInBounce">Ease in bounce</option>
          <option value="easeOutBounce">Ease out bounce</option>
          <option value="easeInOutBounce">Ease in-out bounce</option>
          <option value="easeOutInBounce">Ease out-in bounce</option>
          <option value="easeInSine">Ease in sine</option>
          <option value="easeOutSine">Ease out sine</option>
          <option value="easeInOutSine">Ease in-out sine</option>
          <option value="easeOutInSine">Ease out-in sine</option>
          <option value="easeInCubic">Ease in cubic</option>
          <option value="easeOutCubic">Ease out cubic</option>
          <option value="easeInOutCubic">Ease in-out cubic</option>
          <option value="easeOutInCubic">Ease out-in cubic</option>
        </select>
        <button id="delete-keyframe" type="button" class="btn btn-full danger">Delete Keyframe</button>
      </div>
    </div>
    <div id="nothing"></div>
    <div id="layer-list" >
      <div id="layerhead"><span class="material-icons">layers</span>LAYERS</div>
      <div id="layer-inner-list" class="nolayers">
        <div id="nolayers">
          <h6>No Layers</h6>
          <p>Add an object to get started...</p>
        </div>
      </div>
    </div>
    <div id="timearea">
      <div id="timeline">
        <div id="seekarea">
          <div id="inner-seekarea">
            <div id="seekevents"></div>
          </div>
          <div id="time-numbers" class="noselect"></div>
          <div id="seek-hover"></div>
          <div id="seekbar"></div>
        </div>
        <div id="line-snap"></div>
        <div id="inner-timeline"></div>
      </div>
    </div>
  </div>
  <!-- BOTTOM AREA END -->
  <!-- TIMELINE CONTROLS -->
  <div id="controls" class="noselect ">
    <div id="timeline-wrap"  class="d-none">
      <span class="material-icons timeline-icon">view_timeline</span>
      <input id="timeline-zoom" type="range" min="5" max="47" value="47" step="1" class="rangeslider" autocomplete="off">
      <div id="speed">
        <div id="speed-settings">
          <div class="speed" data-speed="4">
            4.0x
          </div>
          <div class="speed" data-speed="3">
            3.0x
          </div>
          <div class="speed" data-speed="2">
            2.0x
          </div>
          <div class="speed" data-speed="1.5">
            1.5x
          </div>
          <div class="speed" data-speed="1">
            1.0x
          </div>
          <div class="speed" data-speed="0.5">
            0.5x
          </div>
        </div>
        <span class="material-icons">bolt</span>
        <span id="speed-text">1.0x</span>
        <span id="speed-arrow" class="material-icons">expand_more</span>
      </div>
    </div>
    <div id="playback">
      <div id="current-time">
        <input autocomplete="off" value="00:00:00" readonly>
      </div>
      <span id="skip-backward" class="replay-btn">Replay</span>
      <span id="play-button" class="material-icons">play_arrow</span>
      <span id="skip-forward" class="material-icons d-none" >skip_next</span>
      <div id="total-time">
        <input autocomplete="off" value="00:00:00" readonly>
      </div>
    </div>
    <div id="controls-right" class="">
      <button type="button" id="download" class="btn primary">
        <span class="material-icons">download</span>
        Download
      </button>
    </div>
  </div>
  <div id="toolbar" class="noselect toolbar-for-mobile">
    <div id="logo">
      <a href="#">
        <img src="{{asset('assets/logo.png')}}" alt="Palleon Motion">
      </a>
    </div>
    <div id="tool-wrap">
      <div id="object-settings-select" class="tool tool-active material-icon-main" data-id="object-settings">
        <span class="material-icons">tune</span>
        <p>Settings</p>
      </div>
      <div id="layer-select" class="tool" data-id="layer-panel">
        <span class="material-icons">layers</span>
        <p>Layers</p>
      </div>
      <div id="project-tool-select" class="tool material-icon-main" data-id="project-tool">
        <span class="material-icons">perm_media</span>
        <p>Templates</p>
      </div>
      <div id="upload-tool-select" class="tool material-icon-main" data-id="upload-tool">
        <span class="material-icons">cloud_upload</span>
        <p>Uploads</p>
      </div>
      <div id="text-tool-select" class="tool material-icon-main" data-id="text-tool">
        <span class="material-icons">title</span>
        <p>Text</p>
      </div>
      <div id="background-remover-tool-select" class="tool material-icon-main" data-id="background-remover-tool">
        <span class="material-icons">remove_circle</span>
        <p>Background Remover</p>
      </div>
      <div id="text-to-voice-tool-select" class="tool material-icon-main" data-id="text-to-voice-tool">
        <span class="material-icons">remove_circle</span>
        <p>Text to voice </p>
      </div>
      <div id="shape-tool-select" class="tool material-icon-main" data-id="shape-tool">
        <span class="material-icons">interests</span>
        <p>Objects</p>
      </div>
      <div id="image-tool-select" class="tool material-icon-main" data-id="image-tool">
        <span class="material-icons">add_photo_alternate</span>
        <p>Images</p>
      </div>
      <div id="video-tool-select" class="tool material-icon-main" data-id="video-tool">
        <span class="material-icons">videocam</span>
        <p>Videos</p>
      </div>
      <div id="audio-tool-select" class="tool material-icon-main" data-id="audio-tool">
        <span class="material-icons">queue_music</span>
        <p>Audio</p>
      </div>
      <div id="qrcode-tool-select" class="tool material-icon-main" data-id="qrcode-tool">
        <span class="material-icons">qr_code</span>
        <p>QR CODE</p>
      </div>
    </div>
  </div>
  <!-- Background Removal Modal -->
  <div class="modal fade" id="backgroundRemovalModal" tabindex="-1" aria-labelledby="backgroundRemovalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backgroundRemovalModalLabel">Remove Background</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="backgroundRemovalForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3" id="before-remove">
                        <img id="imagePreview" src="" alt="Original Preview" style="max-width: 100%; display: none;">
                    </div>
                    <div class="mb-3" id="processedImageContainer" style="display: none;">
                        <img id="processedImage" src="" alt="Processed Preview" style="max-width: 100%;">
                    </div>
                    <div class="btns-main-wrapper" id="bg-remove-btn">
                        <button type="submit" class="btn btn-primary">Remove Background</button>
                        <a id="downloadButton" class="btn btn-success" href="" download style="display: none;">Download Processed Image</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h4>Removed Background Images</h4>
        <div id="removedImagesGallery" class="d-flex flex-wrap gap-3"></div>
    </div>
</div>

<div class="container mt-4">
        <h4>Removed Background Images</h4>
        <div id="removedImageGallery" class="d-flex flex-wrap gap-3"></div>
    </div>

<!-- Gallery for Removed Background Images -->



      <div class="modal fade" id="textToVoiceModal" tabindex="-1" aria-labelledby="textToVoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="textToVoiceModalLabel">Text to Voice</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <textarea id="text" rows="4" cols="50" placeholder="Enter text to convert to speech"></textarea>
    <button onclick="speakAndRecord()" type="button" class="btn btn-primary">Speak & Save</button>

    <audio id="audioPlayer" controls style="display: none;"></audio>

    <script>
        let mediaRecorder;
        let audioChunks = [];

        async function speakAndRecord() {
            let text = document.getElementById("text").value;

            if (!('speechSynthesis' in window)) {
                alert("Text-to-speech is not supported in your browser.");
                return;
            }

            // Start recording
            let stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            mediaRecorder = new MediaRecorder(stream);
            mediaRecorder.start();

            mediaRecorder.ondataavailable = event => {
                audioChunks.push(event.data);
            };

            mediaRecorder.onstop = () => {
    let audioBlob = new Blob(audioChunks, { type: "audio/wav" });
    let formData = new FormData();
    formData.append("audio", audioBlob, "speech.wav");

    // Send audio to Laravel
    fetch("{{ route('tts.save') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.audio_url) {
            let audioPlayer = document.getElementById("audioPlayer");
            audioPlayer.src = data.audio_url;
            audioPlayer.style.display = "block";
            audioPlayer.play();

            // Call the function to refresh the audio list
            refreshAudioList();
        } else {
            alert("Failed to save audio.");
        }
    });
};

// Function to refresh the audio list
function refreshAudioList() {
    $.ajax({
        url: "/api/audio-files",
        type: "GET",
        dataType: "json",
        success: function (data) {
            let audioList = $("#audio-list");
            audioList.empty(); // Clear existing content

            data.forEach(audio => {
                let audioItem = `
                    <div class="audio-item" data-file="${audio.url}">
                        <div class="audio-preview">
                            <span class="material-icons">play_arrow</span>
                        </div>
                        <img class="audio-thumb" src="${audio.thumbnail}" onerror="this.onerror=null; this.src='{{ asset('files/audio/the-default.png') }}';">
                        <div class="audio-info">
                            <div class="audio-info-title">${audio.name.replace(/-/g, ' ')}</div>
                        </div>
                    </div>
                `;
                audioList.append(audioItem);
            });
        },
        error: function () {
            alert("Failed to load audio files.");
        }
    });
}

            // Speak the text
            let speech = new SpeechSynthesisUtterance(text);
            speech.lang = "en-US";
            speech.rate = 1;
            speech.pitch = 1;
            speech.onend = () => {
                mediaRecorder.stop();
            };

            window.speechSynthesis.speak(speech);
        }
    </script>
            </div>
          </div>
        </div>
      </div>


<!-- Add this before closing body tag -->
<!-- <script>
document.querySelector('#background-remover-tool-select').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('backgroundRemovalModal'));
    modal.show();
});



document.querySelector('#text-to-voice-tool-select').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('textToVoiceModal'));
    modal.show();
});

// Preview image
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const file = e.target.files[0];
    if (file) {
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(file);
    }
});

// Handle form submission
document.getElementById('backgroundRemovalForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/remove-background', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
        // Show the processed image
        document.getElementById('processedImage').src = data.image_url;
        document.getElementById('processedImageContainer').style.display = 'block';
        document.getElementById('downloadButton').href = data.download_url;
        document.getElementById('downloadButton').style.display = 'inline-block';
    } else {
        alert('Error processing image');
    }
})
    .catch(error => {
        console.error('Error:', error);
        alert('Error processing image');
    });
});
</script> -->

<script>
  document.querySelector('#text-to-voice-tool-select').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('textToVoiceModal'));
    modal.show();
});


document.querySelector('#background-remover-tool-select').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('backgroundRemovalModal'));
    modal.show();
});

// Preview image before submission
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const file = e.target.files[0];
    if (file) {
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(file);
    }
});

// Handle form submission
document.getElementById('backgroundRemovalForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/remove-background', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show the processed image
            document.getElementById('processedImage').src = data.image_url;
            document.getElementById('processedImageContainer').style.display = 'block';
            document.getElementById('downloadButton').href = data.download_url;
            document.getElementById('downloadButton').style.display = 'inline-block';

            // Save to local storage
            saveImageToLocalStorage(data.image_url, data.download_url);
            displayStoredImages();
        } else {
            alert('Error processing image');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error processing image');
    });
});

// Save image to local storage
function saveImageToLocalStorage(imageUrl, downloadUrl) {
    let images = JSON.parse(localStorage.getItem('removedImages')) || [];
    images.push({ imageUrl, downloadUrl });
    localStorage.setItem('removedImages', JSON.stringify(images));
}

// Display stored images in the gallery
function displayStoredImages() {
    let images = (JSON.parse(localStorage.getItem('removedImages')) || []).reverse();
    let gallery = document.getElementById('removedImagesGallery');
    gallery.innerHTML = '';

    images.forEach((img, index) => {
        let imageElement = `
            <div class="card" style="width: 150px; position: relative;">
                <button class="btn btn-sm btn-danger" style="position: absolute; top: 5px; right: 5px;" onclick="removeImage(${index})">✖</button>
                <img src="${img.imageUrl}" class="card-img-top" alt="Processed Image">
                <div class="card-body text-center">
                    <a href="${img.downloadUrl}" class="btn btn-success btn-sm" download>Download</a>
                </div>
            </div>
        `;
        gallery.innerHTML += imageElement;
    });
}

function displayStoredImage() {
    let images = (JSON.parse(localStorage.getItem('removedImages')) || []).reverse();
    let gallery = document.getElementById('removedImageGallery');
    gallery.innerHTML = '';

    if (images.length > 0) {
        let imageElement = `
            <div class="card" style="width: 150px; position: relative;">
                <button class="btn btn-sm btn-danger" style="position: absolute; top: 5px; right: 5px;" onclick="removeImage(0)">✖</button>
                <img src="${images[0].imageUrl}" class="card-img-top" alt="Processed Image">
                <div class="card-body text-center">
                    <a href="${images[0].downloadUrl}" class="btn btn-success btn-sm" download>Download</a>
                </div>
            </div>
        `;
        gallery.innerHTML += imageElement;
    }
}
// Remove image from local storage
function removeImage(index) {
    let images = (JSON.parse(localStorage.getItem('removedImages')) || []).reverse();
    images.splice(index, 1);
    localStorage.setItem('removedImages', JSON.stringify(images));
    displayStoredImages();
    displayStoredImage();
}

// Load stored images on page load
document.addEventListener('DOMContentLoaded', () => {
    displayStoredImages();
    displayStoredImage();
});
</script>

  <!-- TIMELINE CONTROLS END -->
  <!-- UPLOADER -->
  <input autocomplete="off" id="emptyInput" value=" " class="o-none">
  <input autocomplete="off" type="file" id="filepick" accept="image/*,video/*,audio/*" multiple>
  <input autocomplete="off" type="file" id="filepick2" accept="audio/*">
  <input autocomplete="off" type="file" id="filepick3" accept="application/json">
  <input autocomplete="off" type="file" id="import" class="d-none" accept=".json" aria-hidden="true">
  <div id="upload-popup">
    <div id="upload-popup-container">
      <div id="upload-popup-header">
        <div id="upload-popup-title">Upload media</div>
        <span id="upload-popup-close" class="material-icons">close</span>
      </div>
      <div id="upload-drop-area">
        <div id="upload-drop-group">
          <span class="material-icons">file_upload</span>
          <div id="upload-drop-title">Click to upload</div>
          <div id="upload-drop-subtitle">Or drag and drop a file</div>
        </div>
      </div>
      <div id="upload-link">
        <input autocomplete="off" id="upload-link-input" placeholder="Paste an image or a video URL">
        <div id="upload-link-add">Add</div>
      </div>
    </div>
    <div id="upload-overlay"></div>
  </div>
  <!-- UPLOADER END -->
  <!-- DOWNLOAD MODAL -->
  <div id="download-modal" class="bottom-modal">
    <div id="download-progress">
      <div class="download-progress">
        <div id="download-progress-title">Rendering Video...</div>
        <div id="download-progress-bar"><div class="progress-bar"><div id="progress-bar-width"></div></div></div>
        <div id="download-progress-desc">5%</div>
      </div>
    </div>
    <div id="download-gif-progress">
      <div class="download-progress">
        <div id="download-gif-progress-preview"><img id="download-gif-preview" src="" /></div>
        <div id="download-gif-progress-desc">Please wait...</div>
      </div>
    </div>
    <div id="download-options">
      <div>
        <input autocomplete="off" class="magic-radio" type="radio" name="download-radio" id="webm-format" value="webm" checked>
        <label for="webm-format" class="magic-radio-label">WebM Video <span class="download-badge bg-success">Recommended</span></label>
      </div>
      <div>
        <div>
          <input autocomplete="off" class="magic-radio" type="radio" name="download-radio" value="gif" id="gif-format">
          <label for="gif-format" class="magic-radio-label">Animated GIF <span class="download-badge bg-warning">Slowest</span></label>
        </div>
        <div id="gif-fps-select" class="download-sub-settings d-none">
          <label class="download-options-label">Quality (1-256):</label>
          <input id="gif-fps" class="form-field" autocomplete="off" min="1" max="256" type="number" value="10" />
        </div>
      </div>
      <div>
        <div>
          <input autocomplete="off" class="magic-radio" type="radio" name="download-radio" value="image" id="image-format">
          <label for="image-format" class="magic-radio-label">Image <span class="download-badge bg-danger">No Animation</span></label>
        </div>
        <div id="image-format-select" class="download-sub-settings d-none">
          <label class="download-options-label">File Format:</label>
          <select id="image-select" class="custom-select" autocomplete="off">
            <option value="png" selected>PNG</option>
            <option value="jpeg">JPEG</option>
            <option value="webp">WebP</option>
          </select>
        </div>
      </div>
    </div>
    <button type="button" class="btn primary btn-full" id="download-real">Start Downloading</button>
  </div>
  <!-- DOWNLOAD MODAL END -->
  <!-- Background overlay -->
  <div id="background-overlay"></div>
  <!-- SCRIPTS -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/fabric.min.js')}}"></script>
  <script src="{{asset('js/plugins.min.js')}}"></script>
  <script src="{{asset('js/pmotion.min.js')}}"></script>
  <script src="{{asset('js/custom.js')}}"></script>
  <script>
    // Select all toggle buttons
    const toggleButtons = document.querySelectorAll(".toggle-btn");
  
    toggleButtons.forEach((button) => {
      button.addEventListener("click", () => {
        // Find the associated template container
        const templateContainer = button.nextElementSibling;
        const arrow = button.querySelector(".arrow");
  
        // Toggle visibility
        templateContainer.classList.toggle("show");
  
        // Update the arrow direction
        if (templateContainer.classList.contains("show")) {
          arrow.innerHTML = "&#x25B2;"; // Up arrow
        } else {
          arrow.innerHTML = "&#x25BC;"; // Down arrow
        }
      });
    });
  </script>
  
  
  <!-- Translation Strings -->
  <script>
    $(document).ready(function() {
      var url = window.location.href;
      if (url.includes('template/')) {
        var id = url.split('template/')[1];
        $('#' + 'template' + id).click();
      }
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script>

    /* <![CDATA[ */
    var pmotionParams = {
        "t1": "Canvas Settings",
        "t2": "Width",
        "t3": "Height",
        "t4": "Color",
        "t5": "Duration (sec)",
        "t6": "Presets",
        "t7": "Layout",
        "t8": "Position X",
        "t9": "Position Y",
        "t10": "Rotation",
        "t11": "Layer",
        "t12": "Opacity",
        "t13": "Fill Color",
        "t14": "Offset X",
        "t15": "Offset Y",
        "t16": "Blur",
        "t17": "Image",
        "t18": "No Filter",
        "t19": "Grayscale",
        "t20": "Sepia",
        "t21": "Black & White",
        "t22": "Retro",
        "t23": "Vintage",
        "t24": "Technicolor",
        "t25": "Kodachrome",
        "t26": "Polaroid",
        "t27": "Invert",
        "t28": "Brightness",
        "t29": "Contrast",
        "t30": "Saturation",
        "t31": "Vibrance",
        "t32": "Hue",
        "t33": "Noise",
        "t34": "Crop Image",
        "t35": "Reset Filters",
        "t36": "Text",
        "t37": "Backward",
        "t38": "Forward",
        "t39": "Letters",
        "t40": "Words",
        "t41": "Preset",
        "t42": "Fade In",
        "t43": "Typewriter",
        "t44": "Slide Top",
        "t45": "Slide Bottom",
        "t46": "Slide Left",
        "t47": "Slide Right",
        "t48": "Scale",
        "t49": "Shrink",
        "t50": "Easing",
        "t51": "Linear",
        "t52": "Ease In Quad",
        "t53": "Ease Out Quad",
        "t54": "Ease In-Out Quad",
        "t55": "Ease Out-In Quad",
        "t56": "Ease In Quart",
        "t57": "Ease Out Quart",
        "t58": "Ease In-Out Quart",
        "t59": "Ease Out-In Quart",
        "t60": "Ease In Quint",
        "t61": "Ease Out Quint",
        "t62": "Ease In-Out Quint",
        "t63": "Ease Out-In Quint",
        "t64": "Ease In Bounce",
        "t65": "Ease Out Bounce",
        "t66": "Ease In-Out Bounce",
        "t67": "Ease Out-In Bounce",
        "t68": "Ease In Sine",
        "t69": "Ease Out Sine",
        "t70": "Ease In-Out Sine",
        "t71": "Ease Out-In Sine",
        "t72": "Ease In Cubic",
        "t73": "Ease Out Cubic",
        "t74": "Ease In-Out Cubic",
        "t75": "Ease Out-In Cubic",
        "t76": "Ease In Circ",
        "t77": "Ease Out Circ",
        "t78": "Ease In-Out Circ",
        "t79": "Ease Out-In Circ",
        "t80": "Ease In Expo",
        "t81": "Ease Out Expo",
        "t82": "Ease In-Out Expo",
        "t83": "Ease Out-In Expo",
        "t84": "Ease In Back",
        "t85": "Ease Out Back",
        "t86": "Ease In-Out Back",
        "t87": "Ease Out-In Back",
        "t88": "Duration",
        "t89": "Audio",
        "t90": "Volume",
        "t91": "Delete Audio",
        "t92": "Enter Your Text Here",
        "t93": "Add a heading",
        "t94": "Add a subheading",
        "t95": "Add body text",
        "t96": "Your text",
        "t97": "Nothing found.",
        "t98": "Load More",
        "t99": "Something went wrong.",
        "t100": "More Settings",
        "t101": "Less Settings",
        "t102": "Upload Audio",
        "t103": "Wrong file type",
        "t104": "Project is empty.",
        "t105": "Error",
        "t106": "You have no saved projects.",
        "t107": "Delete",
        "t108": "Load",
        "t110": "Are you sure you want to delete all images and videos? This action cannot be undone.",
        "t111": "Are you sure you want to clear this project? This action cannot be undone.",
        "t112": "Toggle animation",
        "t113": "Loading...",
        "t114": "Show More",
        "t115": "Show Less",
        "t116": "Error when loading video file",
        "t117": "Video is too short.",
        "t118": "File type not accepted.",
        "t119": "Uploading...",
        "t120": "Upload media",
        "t121": "File is too big.",
        "t122": "The file is not compatible with Pmotion.",
        "t123": "Letter Spacing",
        "t124": "Stroke",
        "t125": "Shadow",
        "t126": "Animation",
        "t127": "Your uploaded images will show up here for easy access.",
        "t128": "Your uploaded videos will show up here for easy access.",
        "t129": "You can not duplicate multiple objects. Please select single object to duplicate.",
        "t130": "Warning",
        "t131": "You can not duplicate animated text. Please create a new one.",
        "t132": "Font Weight",
        "t133": "Normal",
        "t134": "Bold",
        "t135": "Download",
        "t136": "Downloading...",
        "t137": "My Audio -",
        "t138": "Please remove the audio from the canvas first...",
        "t139": "Untitled layer",
        "t140": "Alignment",
        "t141": "Background",
        "t142": "The record is corrupt. Please try again or use another browser.",
    };
    /* ]]> */
  </script>
</body>
<!-- BODY END -->
</html>