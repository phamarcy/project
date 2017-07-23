<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src='jquery-3.2.1.min.js'></script>
    <script>
    function loadThatPage(pageToLoad) {
     $('#yourcontentcol').load(pageToLoad);
    }
    </script>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span4">
                <ul>
                    <li><a href="" onclick="loadThatPage('page.html'); return false;">link 1</a></li>
                    <li><a href="" onclick="loadThatPage('frame.php'); return false;">link 2</a></li>
                    TEST
                </ul>
            </div>
            <div class="span8" id="yourcontentcol">
              asdasdsdsdasd
            </div>
        </div>
    </div>
  </body>
</html>
