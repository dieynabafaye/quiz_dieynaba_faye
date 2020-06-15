$(document).ready(function () {
  
    showAllUsers();

    function showAllUsers() {
        $.ajax({
            url: "../PHP/action.php",
            type: "POST",
            data: {
                action: "view"
            },
            success: function (data) {
                $('#showuser').html(data);

                $('table').DataTable({


                    pagingType: "simple_numbers",

                    // lengthMenu: [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25]
                    "language": {
                        "lengthMenu": 'Limite par page <select id="limite">' +
                            '<option value="1">1</option>' +
                            '<option value="5">5</option>' +
                            '<option value="6">6</option>' +
                            '<option value="7">7</option>' +
                            '<option value="8">8</option>' +
                            '<option value="9">9</option>' +
                            '<option value="10">10</option>' +
                            '<option value="11">11</option>' +
                            '<option value="12">12</option>' +
                            '<option value="13">13</option>' +
                            '<option value="14">14</option>' +
                            '<option value="15">15</option>' +
                            '<option value="16">16</option>' +
                            '<option value="17">17</option>' +
                            '<option value="18">18</option>' +
                            '<option value="13">13</option>' +
                            '<option value="20">20</option>' +
                            '<option value="21">21</option>' +
                            '<option value="22">22</option>' +
                            '<option value="23">23</option>' +
                            '<option value="24">24</option>' +
                            '<option value="25">25</option>' +
                            '<option value="-1">All</option>' +
                            '</select> '
                    }

                });
            }
        });
    }


        $("#inscrire").click(function(e){
            e.preventDefault();
            
            var form = $('#form-inscription')[0];
            var fd = new FormData(form);
            var bool=false;
            if($('#prenom').val()==""){
                    $('#error1').text('Veuillez saisir un prenom!')
                   bool= true
                }else{
                    $('#error1').text('')
                }
                if($('#nom').val()==""){
                    $('#error2').text('Veuillez saisir un nom!')
                    bool= true
                }else{
                    $('#error2').text('')
                }
                 if($('#login').val()==""){
            $('#error3').text('Veuillez saisir un login!')
            bool= true
        }else{
            $('#error3').text('')
        }
        if($('#pwd').val()=="" ||$('#pwd2').val()!=$('#pwd').val() ){
            $('#error4').text('Veuillez saisir un mot de passe!')
            bool= true
        }else{
            $('#error4').text('')
        }
        if($('#pwd2').val()==""){
            $('#error5').text('Veuillez saisir un mot de passe identique au précédent!')
            bool= true
        }else{
            $('#error5').text('')
        }
                if(bool==false){
            $.ajax({
                url: '../PHP/action.php',  
                type: 'POST',
                data: fd,
                enctype: "multipart/form-data",
                cache: false,
                timeOut: 600000,
                contentType: false,
                processData: false,
                success: function(response){
                    $("form").trigger("reset");
                     data =JSON.parse(response);
                    if(data.error=="vrai"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ce login existe déjà!'
                        })
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Bravo...',
                            text: 'Inscription Validé!'
                        })
                        window.location.href='../PHP/connexion.php';
                    }
                },
            });
        }else{
            alert('Veuillez Saisir tous les champs!')
        }
    
        });

        // update joueur
       

        
       


        // delete joueur
        $("body").on("click", ".delBtn", function (e) {
            e.preventDefault();
            var tr =$(this).closest('tr');
            del_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                    if (result.value) {
                $.ajax({
                    url:'../PHP/action.php',
                    type:'POST',
                    data:{del_id:del_id},
                    success:function(response){
                      
                       data =JSON.parse(response);
                       
                        showAllUsers();
                        
                    }
                });
                }
             
        });
    });



});
    // view image user
function handleFiles(files) {
    var imageType = /^image\//;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (!imageType.test(file.type)) {
            alert("veuillez sélectionner une image");
        } else {
            if (i == 0) {
                preview.innerHTML = '';
            }
            var img = document.createElement("img");
            img.classList.add("obj");
            img.file = file;
            preview.appendChild(img);
            var reader = new FileReader();
            reader.onload = (function (aImg) {
                return function (e) {
                    aImg.src = e.target.result;
                };
            })(img);

            reader.readAsDataURL(file);
        }

    }
}

var nbrow = 0;
var i=0;
function genere() {
nbrow++;
i++;
    var choise=document.getElementById('select');
    var divInputs =document.getElementById('hautgener');
    var newInput= document.createElement('div');
    newInput.setAttribute('class','divgener');
    newInput.setAttribute('id','row_'+nbrow);
    if(typ.value=="choixMultiple"){
        newInput.innerHTML ='<input class="inpgener" type="text" name="rep['+i+']" id="inpgener" placeholder="reponse'+i+'">&nbsp;&nbsp;<input class="checkgener" type="checkbox" name="vrais[]" value="'+i+'" id="checkgener">&nbsp;&nbsp;<i class="fas fa-trash-alt fa-lg text-danger deletgener p-3"onclick="ondelete('+nbrow+')"></i>'
                ;
        divInputs.appendChild(newInput);

        
    }
    if(typ.value=="choixSimple"){
        newInput.innerHTML ='<input class="inpgener" type="text" name="rep['+i+']" id="inpgener" placeholder="reponse'+i+'">&nbsp;&nbsp;<input class="checkgener" type="radio" name="vrais" value="'+i+'" id="checkgener">&nbsp;&nbsp;<i class="fas fa-trash-alt fa-lg text-danger deletgener p-3"onclick="ondelete('+nbrow+')"></i>'
                ;
        divInputs.appendChild(newInput);
    }
    if(typ.value=="choixText"){
        newInput.innerHTML ='<input class="inpgener" type="text" name="rep" id="inpgener" placeholder="reponse'+i+'">&nbsp;&nbsp;<i class="fas fa-trash-alt fa-lg text-danger deletgener"onclick="ondelete('+nbrow+')"></i>'
                ;
        divInputs.appendChild(newInput);
        if (i>=1) {
            genere.setAttribute('disabled','disabled');
        }
        // generer.setAttribute('type','hidden');
    }
}
function ondelete(n) {
    var target = document.getElementById('row_'+n);
    target.remove();
    
}