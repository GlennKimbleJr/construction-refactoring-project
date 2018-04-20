<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$this->e(isset($title) ? $title : 'Construction Database')?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/includes/css/dashboard.css" />
    <link rel="stylesheet" type="text/css" href="/includes/css/ddimgtooltip.css" />
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/index">Construction Database</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/index">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/projects">
                  <span data-feather="clipboard"></span>
                  Projects
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/contacts">
                  <span data-feather="users"></span>
                  Contacts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/categories">
                  <span data-feather="layers"></span>
                  Categories
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/zones">
                  <span data-feather="compass"></span>
                  Zones
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/reports">
                  <span data-feather="bar-chart-2"></span>
                  Reports
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?=$this->e(isset($title) ? $title : 'Dashboard')?></h1>
          </div>

          <div>
            <?=$this->section('content')?>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="/includes/js/imtech_pager.js"></script>
    <script type="text/javascript">
        var pager = new Imtech.Pager();
        $(document).ready(function() {
            pager.paragraphsPerPage = 15; // set amount elements per page
            pager.pagingContainer = $('#pagenation'); // set of main container
            pager.paragraphs = $('div.z', pager.pagingContainer); // set of required containers
            pager.showPage(1);
        });
    </script>
    <script src="/includes/js/ddimgtooltip.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
