<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Palleon</title>
</head>
<body>
    <h2>Choose Template</h2>
    <div id="project-library" class="nav-tab-content">
        <div id="template-library" class="css-grid" style="display: flex;">
          <div onclick="goTo(1)" style="margin-right: 10px;" class="image-grid-item" data-template="{{asset('files/templates/1.json')}}" title="Template 1">
            <div class="img-wrap">
              <div class="img-loader"></div>
              <img class="lazy" src="{{asset('files/templates/1.png')}}" width="280px" height="280px" alt="" draggable="false" />
            </div>
          </div>
          <div onclick="goTo(2)" style="margin-right: 10px;" class="image-grid-item" data-template="{{asset('files/templates/2.json')}}" title="Template 2">
            <div class="img-wrap">
              <div class="img-loader"></div>
              <img class="lazy" src="{{asset('files/templates/2.png')}}" width="280px" height="280px" alt="" draggable="false" />
            </div>
          </div>
          <div onclick="goTo(3)" style="margin-right: 10px;" class="image-grid-item" data-template="{{asset('files/templates/3.json')}}" title="Template 3">
            <div class="img-wrap">
              <div class="img-loader"></div>
              <img class="lazy" src="{{asset('files/templates/3.png')}}" width="280px" height="280px" alt="" draggable="false" />
            </div>
          </div>
          <div onclick="goTo(4)" style="margin-right: 10px;" class="image-grid-item" data-template="{{asset('files/templates/4.json')}}" title="Template 4">
            <div class="img-wrap">
              <div class="img-loader"></div>
              <img class="lazy" src="{{asset('files/templates/4.png')}}" width="280px" height="280px" alt="" draggable="false" />
            </div>
          </div>
        </div>
      </div>
<script>
    function goTo(templateId) {
        // var template = JSON.parse(document.querySelector(`[data-template="${asset('files/templates/' + templateId + '.json')}"`).getAttribute('data-template'));

        window.location.href = '/template/' + templateId;
    }
</script>
    </body>
</html>

