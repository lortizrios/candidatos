<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!--jQuery is required-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand">INTER Bayamón</a> 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="candidatos-registrados.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registrar-candidato.php">Registrar Candidatos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="excandidatos-registrados.php">Ex-candidatos</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0"  >
      <input class="form-control mr-sm-2" type="text" name="search" id="search_ex" placeholder="Buscar">
    </form>
  </div>
</nav>

<script>
    $(document).ready(function(){
        load_data();
        function load_data(query)
        {
            $.ajax({
                url:"listado-excandidatos.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#excandidatos').html(data);
                }
            });
        }
        
        $('#search_ex').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();			
            }
        });
    });
</script>