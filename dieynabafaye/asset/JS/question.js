$('#addquestion').submit(function(e){
    e.preventDefault();
    alert('okkk')
    
        $.ajax({
            url: '../PHP/traitementquestion.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(data){
                $("form").trigger("reset");  
                Swal.fire({
                icon: 'success',
                title: 'Bravo...',
                text: 'Question enregistrée avec succés!'
            })
            
            }
        });
    
});
$(document).ready(function(){
              // delete ajax questions
              $("body").on("click", ".delBtn", function (e) {
                e.preventDefault();
               
                delq_id = $(this).attr('id');
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
                            url: "../PHP/action.php",
                            type: "POST",
                            data: {
                                delq_id: delq_id
                            },
                            success: function (response) {
                                $("form").trigger("reset");
                                data =JSON.parse(response);
                                if(data.error =='faux'){
                                    
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'question deleted successfully!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    
                                }else{
                                   
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'question not deleted successfully!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                   
                                }
                            }
                        });
                    }
                });
            });

    // update question
     $("body").on("click", ".editBtn", function (e) {
        //console.log("working");
        e.preventDefault();
        editq_id = $(this).attr('id');
        $.ajax({
            url: "../PHP/updatequestion.php",
            type: "POST",
            data: {
                editq_id: editq_id
            },
            success: function (response) {
                $("form").trigger("reset");
                data = JSON.parse(response);
                 $("#numquestion").val(data[0].numquestion);
                 $("#question").val(data[0].nomquestion);
                 $("#nbrep").val(data[0].nbpoint);
                 $("#typ").val(data[0].type);
               

                
            }
        });
    });
    

    //validation update question
    $('#addquestions').submit(function(e){
        e.preventDefault();
      
        
            $.ajax({
                url: '../PHP/updatequestion.php',
                type: 'POST',
                data: $(this).serialize() +"&action=updatequestion",
                success: function(response){
                    $("form").trigger("reset");
                data = JSON.parse(response);
                    if(data.result=="faux"){
                        Swal.fire({
                            icon: 'success',
                            title: 'question updated successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $("#myModal").modal('hide');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'question not updated successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                   
                }
            });
        
    });let offset = 0;
    $('#scroll').click(function(){
        alert('OK');
   
        // const date = $('#date').val();
        
        // const tbody = $('#tbody');
        $.ajax({
                type: "POST",
                url: "../PHP/scroll.php",
                data: {limit:2,offset:offset},
                dataType: "JSON",
                success: function (data) {
                    // tbody.html('')
                    console.log(data);
                    offset +=2
                }
            });
        });
        // scroll
        const scrollZone = $('#scrollZone')
        scrollZone.scroll(function(){
        //console.log(scrollZone[0].clientHeight)
        const st = scrollZone[0].scrollTop;
        const sh = scrollZone[0].scrollHeight;
        const ch = scrollZone[0].clientHeight;

        // console.log(st,sh, ch);
        
        if(sh-st <= ch){
            $.ajax({
                type: "POST",
                url: "../PHP/scroll.php",
                data: {limit:2,offset:offset},
                
                success: function (data) {
                    console.log(data);
                    $('#scrollZone').html(data);
                    offset +=2;
                }
            });
        }
           
        })
    });
    
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
   