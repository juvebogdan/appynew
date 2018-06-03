<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>IPTV TV Series</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>
  <!-- InstanceBeginEditable name="EditingPane" -->
      <div class="editingwindow">
      <div class="price">
        <div align="center">TV Series Genre Images</div>
      </div>
      <div class="trueHalf">Select a Genre
        <form id="form7" name="form7" method="post" action="">
          <label>
            <select name="select3" id="movies">
             <option value="">Choose a Genre</option>
          <option value="Latest">Latest</option>
          <option value="Highly-Rated">Highly Rated</option>
          <option value="Action">Action</option>
          <option value="Animation">Animation</option>
          <option value="Biography">Biography</option>
          <option value="Comedy">Comedy</option>
          <option value="Crime">Crime</option>
          <option value="Documentary">Documentary</option>
          <option value="Drama">Drama</option>
          <option value="Family">Family</option>
          <option value="Fantasy">Fantasy</option>
          <option value="Game-Show">Game Show</option>
          <option value="History">History</option>
          <option value="Horror">Horror</option>
          <option value="Music">Music</option>
          <option value="Musical">Musical</option>
          <option value="Mystery">Mystery</option>
          <option value="News">News</option>
          <option value="Reality-TV">Reality TV</option>
          <option value="Romance">Romance</option>
          <option value="Sci-Fi">Sci-Fi</option>
          <option value="Sport">Sport</option>
          <option value="Superhero">Superhero</option>
          <option value="Talk-Show">Talk Show</option>
          <option value="Thriller">Thriller</option>
          <option value="War">War</option>
          <option value="Western">Western</option>
          <option value="Misc">Misc</option>
            </select>
          </label>
        </form>
      </div>
      <div class="trueHalf">
        <p align="center">Image Preview</p>
      <p align="center"><img alt="" class='img3' style='width:170px;height:100px;border:1px solid red;' /><br />
      <span class="tiny">Image dimensions 340px x 200px in PNG format</span></p>
      <p align="center">
        <input class="button" type="file" name="icon" id="imgInp3" value='BROWSE' style="display: none;"/>
        
        <input type="button" class="button" onclick="document.getElementById('imgInp3').click();" value='BROWSE' />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="save3" class="button"><i id='load3' class=""></i> SAVE</button>
      </p>
      </div>
    </div>
      <div class="editingwindow">
        <hr />
        <div class="price">
          <div align="center">Add Data For Misc. TV Shows<br />
          <span class="tiny">The API could not find data for these titles. Edit the title correctly and click search. The description and image will self populate from the API with the complete data once the TV Show is found. Then click submit.</span></div>
        </div>
        <div class="trueHalf"><br />
          Select Title
          <label>
            <select name="select" id="notfound">
              <option value=''>Choose a title to edit</option>
              <?php
                foreach($not_found as $key=>$value)
                {
                  printf('<option value="%s">%s</option>',trim($value),trim($value));
                }
              ?>              
            </select>
          </label>
        </br>
        Edit Series Title
          <label>
            <input type="text" name="textfield" id="edittitle" style="width: 100%"/>
          </label>
        <br />
        </br>
        Serie IMDB link
          <label>
            <input type="text" name="textfield" id="titlelink" style="width: 100%"/>
          </label>
        <br />         
          Description
          <label>
            <textarea name="textarea" id="desc" cols="45" rows="5" style="width: 100%"></textarea>
          </label>
        </div>
        <div class="trueHalf">
          <p align="center"><br />
            Preview Image</p>
           <p align="center"><img alt="" class='img2' style='width:100px;height:156px;border:1px solid red;' /><br />
        </p>
            <div align="center">
              <?php echo form_open('', 'id="form1"'); ?>
              <button id="search" class="button"><i id='load1' class=""></i> Search</button>
              <button id="submit" class="button"><i id='load2' class=""></i> Submit</button>
              <?php echo form_close(); ?>
            </div>
        </div>
        <div class="price"></div>
      </div>


    <div class="editingwindow">
      <div class="price">
        <hr />
        <p align="center">Manually Edit<br />
        <span class="tiny">If the API can't find your title or you don't like the result the API found you can manually edit it here.</span></p>
      </div>
      <div class="trueHalf">Select Title
          <label>
            <select name="select2" id="manualtitle">
              <option value=''>Choose a title to edit</option>
              <?php
                foreach($manual as $key=>$value)
                {
                  printf('<option value="%s">%s</option>',trim($value[1]),trim($value[0]));
                }
              ?>              
            </select>
          </label>
        <br />
        Edit  Title
        <form id="form6" name="form1" method="post" action="">
  <label>
    <input type="text" name="textfield2" id="manualedittitle" />
  </label>
</form>
<br />
Edit Genre<br />
<select name="select4" id="manualgenre">
  <option selected="selected">Choose a Genre</option>
  <option value="Latest">Latest</option>
  <option value="Highly-Rated">Highly Rated</option>
  <option value="Action">Action</option>
  <option value="Animation">Animation</option>
  <option value="Biography">Biography</option>
  <option value="Comedy">Comedy</option>
  <option value="Crime">Crime</option>
  <option value="Documentary">Documentary</option>
  <option value="Drama">Drama</option>
  <option value="Family">Family</option>
  <option value="Fantasy">Fantasy</option>
  <option value="Game-Show">Game Show</option>
  <option value="History">History</option>
  <option value="Horror">Horror</option>
  <option value="Music">Music</option>
  <option value="Musical">Musical</option>
  <option value="Mystery">Mystery</option>
  <option value="News">News</option>
  <option value="Reality-TV">Reality TV</option>
  <option value="Romance">Romance</option>
  <option value="Sci-Fi">Sci-Fi</option>
  <option value="Sport">Sport</option>
  <option value="Superhero">Superhero</option>
  <option value="Talk-Show">Talk Show</option>
  <option value="Thriller">Thriller</option>
  <option value="War">War</option>
  <option value="Western">Western</option>
  <option value="Misc">Misc</option>
</select>
<br />
<br />
Edit Description
<label>
  <textarea name="textarea2" id="manualdesc" cols="45" rows="5"></textarea>
</label>
      </div>
      <div class="trueHalf">
        <p align="center">Edit Image</p>
        <p align="center"><img alt="" class='img1' style='width:100px;height:156px;border:1px solid red;' /><br />
        </p>
        <p align="center">Image URL:
          <input type="text" name="textfield3" id="manualimgurl" />
          <input type="button" name="button4" id="showimgurl" value="OK" />
          <br />
        <span class="tiny">Right click an online image,  select &quot;Copy Image Address&quot;, paste above and click &quot;OK&quot;</span></p>
        <form id="form9" name="form4" method="post" action="">
          <div align="center">
            <p>
            <?php echo form_open('', 'id="form7"'); ?>
              <button id="manualsubmit" class="button"><i id='load4' class=""></i> Submit</button>
            <?php echo form_close(); ?>
            </p>
          </div>
        </form>
      </div>
    </div>



  <!-- InstanceEndEditable --></div>
<div class="alert alert-success alert-flash" role="alert" id='flash' style='display: none;'>
  <strong>Data is updated</strong>
</div>
<div class="alert alert-danger alert-flash" role="alert" id='flasherror' style='display: none;'>
  <strong>Not found</strong>
</div> 
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/flash.js"></script>
<script src="<?php echo base_url(); ?>js/iptvseries.js"></script>

<script type="text/javascript">
      $('#movies').on('change', function() {
      var ime=$(this).val();
      $ime=ime.replace(/\:|\¬|\||\,|\/|\\/g, '');
      ime=ime.replace(' ', '');
      //console.log(ime);
      <?php
      if($_SESSION['username']=='FissNew')
        echo "var src='http://appy.zone/iptv/images/series/'+ime+'.png';";
      else
        echo "var src='http://appy.zone/".$_SESSION['username']."/iptv/images/series/'+ime+'.png';";
      ?>
      $(".img3").attr("src", src);    
  }); 
</script>
<!-- InstanceEnd --></html>
