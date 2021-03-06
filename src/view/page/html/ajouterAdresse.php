

  
  <!-- Modal -->
  <div style="color:black" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"  id="exampleModalLabel">Ajouter une adresse</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="script_php/ajouterAdresse.php?page=<?php echo $page?>" method="post" onsubmit = "return validateForm('adresse',['nomAdresse','rue','ville','pays','codePostal'],'errordiv')">
              <div id='form-mod'>
                  <div style="display:flex;flex-direction:row">
                      <input type="text" 
                              class="form-control form-mod" 
                              placeholder="Num"
                              style="width:20%"
                              name="numeroVoie">

                      <input type="text" 
                              class="form-control form-mod" 
                          id='rue'
                          placeholder="Rue"
                          name="rue"
                          >
                  </div>
  
                  <div style="display:flex;flex-direction:row">
                      <input type="text" 
                              class="form-control form-mod" 
                              id='ville'
                          placeholder="Ville"
                          name="ville"
                          >
  
                      <input type="text" 
                              class="form-control form-mod" 
                              id='codePostal'
                              placeholder="Code postal"
                              style="width:35%"
                              name="codePostal"
                              id="codePostal"
                              >
  
                      
                  </div>
                  
                 
                  
                  <input type="text" 
                          class="form-control form-mod" 
                          id='pays'
                          placeholder="Pays"
                          name="pays"
                          >
                  
                  <input type="text" 
                          class="form-control form-mod" 
                          id='nomAdresse'
                          placeholder="Nom"
                          name="nomAdresse"
                          >
              </div>
              <div id="errordiv" style="color:red;margin-left: 6px;"></div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" name="submitAdresse" id="submitAdresse"  class="btn btn-primary">Ajouter</button>
        </div>
        </form>
      </div>
    </div>
  </div>



  