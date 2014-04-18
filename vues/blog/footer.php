          </div>
          
          <nav class="span4">
            <h2>Admin</h2>
            <ul>
                <li><a href="?visu=0">Afficher les billets non plubliés</a></li><!--Permet d'afficher les non plubliés-->
                <li><a href="?visu=1">Afficher les billets plubliés</a></li><!--Permet d'afficher les plubliés-->
            </ul>
            <h2>Tags</h2>
            <ul><!--Debut de l'affichage des tags-->
                <?php
                foreach($tags as $libelle_liste) :
                ?>
                    <li><?php echo $libelle_liste['libelle'] ?></li>
                <?php
                endforeach;
                ?>
            </ul>
            
          </nav>
        </div>
        
      </div>

      <footer>
        <p>Le blog pour la formation RSC 2014, à rendre pour le 18 avril 2014</p>
      </footer>

    </div>

  </body>
</html>

