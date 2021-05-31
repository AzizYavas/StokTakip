<?php 
    try {

        $db = new PDO("mysql:host=localhost:3308;dbname=ogrenci2;charset=utf8","root","");
        
        }catch(PDOException $e) {
        
        echo "Bağlanamadı Hata Kodu : " . $e->getMessage();
        }
        
    

class anasayfa {

    function listeanasayfa($anasayfadb) {


        $anasayfaurun=$anasayfadb->prepare("SELECT * FROM urunler");

        if($anasayfaurun->execute()):

        ?>

        <div class="container ">

        <div class="col-lg-12 col-md-12 col-xl-12 mx-auto bg-light" style="text-align: center; z-index: -1" >
            <a href="control.php?islem=anaparaliste" class="btn btn-success m-2">Kasa</a>
        <div>

            <div class="row text-center mt-1 text-center mx-auto ">

                <div class="col-lg-8 col-md-8 col-xl-8 mx-auto  bg-light border border-secondary">
            
                        <div class="row ">
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-danger  font-weight-bold border-right border-bottom p-1" >ÜRÜN AD</div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-danger  font-weight-bold border-right border-bottom p-1" >ÜRÜN TÜRÜ</div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-danger font-weight-bold border-right border-bottom p-1" >ÜRÜN STOK DURUMU</div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-danger  font-weight-bold border-right border-bottom p-1" >ÜRÜN FİYATI</div>	
                        </div>
                        
                        <div class="row">
                        
                        <?php 
                        
                        while($anasayfalisteson=$anasayfaurun->fetch(PDO::FETCH_ASSOC)):
                        
                        ?>

                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $anasayfalisteson["adi"]; ?></div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $anasayfalisteson["turu"]; ?></div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $anasayfalisteson["stok"]; ?></div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $anasayfalisteson["fiyat"]; ?></div>	
                            
                            <?php 
                        
                            endwhile;

                            endif; 
                        
                            ?>
                                
                        </div>
                                        
            </div>

</div>

</div>

        <?php
    }

    }



class kullanicilar {

    function listekulad($listekuladdb){

        $listekulad=$listekuladdb->prepare("SELECT * FROM kullanici");

        if($listekulad->execute()):

        ?>

        <div class="container">

        <div class="row text-center mt-1 text-center mx-auto">
        <div class="col-lg-10 col-md-10 col-xl-10 mx-auto bg-light" >
        <a href="control.php?islem=kuladekle" class="btn btn-success m-2">Kullanıcı Ekle</a>
        <div>
        
            <div class="row text-center mt-1 text-center bg-light mx-auto">
                <div class="col-lg-12 col-md-12 col-xl-12 mx-auto bg-light border border-secondary">
            
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-dark font-weight-bold border-right border-bottom p-1" >AD</div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-dark font-weight-bold border-right border-bottom p-1" >YETKİ</div>	
                            <div class="col-lg-6 col-md-6 col-xl-6 text-center text-dark font-weight-bold border-right border-bottom p-1" >İŞLEMLER</div>	
                        </div>
                        
                        <div class="row">
                        
                        <?php 
                        
                        while($listeson=$listekulad->fetch(PDO::FETCH_ASSOC)):
                        
                        ?>

                            <div class="col-lg-4 col-md-3 col-xl-3 text-center text-dark font-weight-bold border-right border-bottom p-1" ><?php echo $listeson["kulad"]; ?></div>	
                            <div class="col-lg-3 col-md-3 col-xl-3 text-center text-dark font-weight-bold border-right border-bottom p-1" >
                                <?php 

                                $yetkili=$listeson["yetki"];    

                                if($yetkili==1):

                                    echo "Yönetici";
                                
                                elseif($yetkili==2):

                                    echo "Depo Görevlisi";

                                else:

                                    echo "Kasiyer";

                                endif;
                                
                                ?>
                            </div>	
                            <div class="col-lg-6 col-md-6 col-xl-6 text-center text-dark font-weight-bold border-right border-bottom p-1" >
                            <a href="control.php?islem=kulsil&id=<?php echo $listeson["id"];?>" class="btn btn-danger btn-sm">Sil</a>
                            <a href="control.php?islem=kulguncelle&id=<?php echo $listeson["id"];?>" class="btn btn-success btn-sm" >Güncelle</a>
                            <a href="control.php?islem=sifresifirla&id=<?php echo $listeson["id"];?>" class="btn btn-primary btn-sm" >Şifre Sıfırla</a>
                            </div>
                           
                            <?php 
                        
                            endwhile;

                            endif; 
                        
                            ?>
                                
                        </div>
                    
                    </div>
                
                </div>
            </div>


        <?php
    }


    function kuladekle($kulekledb){

        ?>

        <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-8 col-md-8 col-xl-8 text-center mx-auto mt-2">

        <?php
        if($_POST["buton"]):

            $kulad=$_POST["kulad"];
            $sifre=$_POST["sifre"];
            $yetki=$_POST["yetki"];
            

            if(empty($kulad) || empty($sifre) || empty($yetki)):

                echo "boş yer olmaz";
                header("refresh:2,url=control.php?islem=kuladekle");

            else:

                $kulekle=$kulekledb->prepare("INSERT INTO kullanici (kulad,sifre,sifre2,yetki) VALUES (:kulad,:sifre,:sifre2,:yetki)");

                $kulekle->bindParam(":kulad",$kulad);
                $kulekle->bindParam(":sifre",md5(sha1(md5($_POST["sifre"]))));
                $kulekle->bindParam(":sifre2",md5(sha1(md5($_POST["sifre"]))));
                $kulekle->bindParam(":yetki",$yetki);
               
                if($kulekle->execute()):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">OLDU </div></div>';
                    header("refresh:2,url=control.php?islem=listekulad");

                else:

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                    header("refresh:2,url=control.php?islem=listekulad");

                endif;
            
            endif;
        
        endif;


        ?>

        <div class="container">
            <div class="row text-center">
                        <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
                        <form action="" method="POST">

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <input type="text"  name="kulad" class="form-control" placeholder="Kullanıcı Adı">
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <input type="text"  name="sifre" class="form-control" placeholder="Şifre">
                        </div>	

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center text-danger font-weight-bold mt-1">
                            YETKİ 
                        <select name="yetki" class="form-control">
                        <option value="" selected >Seçiniz</option>
                        <option value="1">Yönetici</option>
                        <option value="2">Depo Görevlisi</option>
                        <option value="3">Kasiyer</option>
                        </select> 
                        </div>						
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="KAYDET" class="btn btn-danger">
                        </form>
                    </div>					
                        
                        </div>
            </div>

            </div>
            
            </div>

            </div>

        </div>


        <?php

    }


    function kulguncelle($kulguncelledb){

        ?>

        <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">


        <?php

        if(isset($_GET["id"])):

            $kulgoster=$kulguncelledb->prepare("SELECT * FROM kullanici WHERE id=".$_GET["id"]);
            $kulgoster->execute();
            $kulgosterson=$kulgoster->fetch(PDO::FETCH_ASSOC);

        endif;

        ?>
                
                        <form action="" method="POST">

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b>Kullanıcı Adı</b>
                        <input type="text"  name="kulad" class="form-control" value="<?php echo $kulgosterson["kulad"]; ?>">
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b>Eski Şifre</b>
                        <input type="password"  name="eskisifre" class="form-control" placeholder="Eski Şifre">
                        </div>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b>Yeni Şifre</b>
                        <input type="password"  name="yenisifre" class="form-control" placeholder="Yeni Şifre">
                        </div>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b>Yeni Şifre Tekrar</b>
                        <input type="password"  name="yenisifretekrar" class="form-control" placeholder="Yeni Şifre Tekrar">
                        </div>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b>Kullanıcı Yetki :</b>
                        <select name="yetki" id="">
                        <option value="1" <?php if($kulgosterson["yetki"]=="1"):?> selected <?php endif; ?> >Yönetici</option>
                        <option value="2" <?php if($kulgosterson["yetki"]=="2"):?> selected <?php endif; ?> >Depo Görevlisi</option>
                        <option value="3" <?php if($kulgosterson["yetki"]=="3"):?> selected <?php endif; ?> >Kasiyer</option>
                        </select> 
                        </div>						
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="Güncelle" class="btn btn-danger">
                        <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                        </div>
                        </form>

                    </div>					
                        
                        </div>
            
            
            </div>
            
        </div>

        <?php

            $eskisifregetir=$kulguncelledb->prepare("select sifre from kullanici");
            $eskisifregetir->execute();
            $eskisifreson=$eskisifregetir->fetch(PDO::FETCH_ASSOC);


        if($_POST["buton"]):

            $kulad=$_POST["kulad"];
            $eskisifre=$_POST["eskisifre"];
            $yenisifre=$_POST["yenisifre"];
            $yenisifretekrar=$_POST["yenisifretekrar"];
            $yetki=$_POST["yetki"];
            $id=$_POST["kayit"];

           
            if(empty($kulad) || empty($yetki) || empty($eskisifre) || empty($yenisifre) || empty($yenisifretekrar)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
                header("refresh:2,url=control.php?islem=listekulad");
                

            else:

                $kulguncel=$kulguncelledb->prepare("UPDATE kullanici SET 
                
                kulad=:kulad,
                sifre=:sifre,
                yetki=:yetki
                
                WHERE id=:id

                ");

                $kulguncel->bindParam(":kulad",$kulad);
                $kulguncel->bindParam(":sifre",md5(sha1(md5($_POST["yenisifretekrar"]))));
                $kulguncel->bindParam(":yetki",$yetki);
                $kulguncel->bindParam(":id",$id);


                if(md5(sha1(md5($_POST["eskisifre"])))!=$eskisifreson["sifre"]):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">ESKİ ŞİFRENİZ AYNI DEĞİL</div></div>';
                    header("refresh:2,url=control.php?islem=listekulad");
                    
                    elseif($eskisifre==$yenisifre && $eskisifre==$yenisifretekrar):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">ESKİ ŞİFRENİZ AYNI !!</div></div>';
                    header("refresh:2,url=control.php?islem=listekulad");


                    elseif($yenisifre!=$yenisifretekrar):

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">YENİ ŞİFRELER AYNI DEĞİL !!</div></div>';
                        header("refresh:2,url=control.php?islem=listekulad");


                        elseif($kulguncel->execute()):
                    
                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">GÜNCELLENDİ</div></div>';
                            header("refresh:2,url=control.php?islem=listekulad");

                    else:

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">GÜNCELLENMEDİ !!</div></div>';
                        header("refresh:2,url=control.php?islem=listekulad");

                endif;



            endif;

        endif;



    }

    function kulsil($kulsildb){

        $kulsil=$kulsildb->prepare("DELETE FROM kullanici WHERE id=".$_GET["id"]);
        
        if($kulsil->execute()):

            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">SİLİNDİ</div></div>';
            header("refresh:2,url=control.php?islem=listekulad");


        else:

            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">SİLİNMEDİ !!</div></div>';
            header("refresh:2,url=control.php?islem=listekulad");



        endif;
    }

    function sifresifirla($sifresifirladb) {

        $rand=substr(md5(microtime()),rand(0,26),8);
       
            $sifre=$rand;
            $id=$_GET["id"];
           
                $kulguncel=$sifresifirladb->prepare("UPDATE kullanici SET 
                
                sifre=:sifre
               
                WHERE id=:id

                ");

                $kulguncel->bindParam(":sifre",$sifre);
                $kulguncel->bindParam(":id",$id);


                if($kulguncel->execute()):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">GÜNCELLENDİ, ŞİFRENİZ :</div></div>'.$rand;
                    header("refresh:2,url=control.php?islem=listekulad");

                    else:

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">GÜNCELLENMEDİ !!</div></div>';
                        header("refresh:2,url=control.php?islem=listekulad");

                endif;



    }


}

class kategoriler {

    function listekat($listekatdb){

        $listekat=$listekatdb->prepare("SELECT * FROM kategoriler");

        if($listekat->execute()):

        ?>

        <div class="container">
        <div class="row text-center mt-1 text-center mx-auto">
        <div class="col-lg-12 col-md-12 col-xl-12 mx-auto bg-light">
        <a href="control.php?islem=katekle" class="btn btn-success m-2">Kategori Ekle</a>
            <div>

                <div class="col-lg-8 col-md-8 col-xl-8 mx-auto bg-light border border-secondary">
            
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xl-4 text-center text-danger  font-weight-bold border-right border-bottom p-1" >KATEGORİ AD</div>	
                            <div class="col-lg-8 col-md-8 col-xl-8 text-center text-danger  font-weight-bold border-right border-bottom p-1" >İŞLEMLER</div>	
                        </div>
                        
                        <div class="row">
                        
                        <?php 
                        
                        while($listeson=$listekat->fetch(PDO::FETCH_ASSOC)):
                        
                        ?>

                            <div class="col-lg-4 col-md-4 col-xl-4 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $listeson["kategoriad"]; ?></div>	
                            <div class="col-lg-8 col-md-8 col-xl-8 text-center text-dark  font-weight-bold border-right border-bottom p-1" >
                            <a href="control.php?islem=katsil&id=<?php echo $listeson["id"];?>" class="btn btn-danger">Sil</a>
                            <a href="control.php?islem=katguncelle&id=<?php echo $listeson["id"];?>" class="btn btn-success">Güncelle</a>
                            </div>
                            
                           
                            <?php 
                        
                            endwhile;

                            endif; 
                        
                            ?>
                                
                        </div>
            </div>
    </div>

    </div>

    </div>

</div>

        <?php
    }


    function katekle($katekledb){

        ?>

        <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">

        <?php

        if($_POST["buton"]):

            $katadi=$_POST["katad"];

            if(empty($katadi)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
                header("refresh:2,url=control.php?islem=kategoriliste");


            else:

                $katekle=$katekledb->prepare("INSERT INTO kategoriler (kategoriad) VALUES (:kategoriad)");

                $katekle->bindParam(":kategoriad",$katadi);

                if($katekle->execute()):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">KATEGORİ EKLENDİ</div></div>';
                    header("refresh:2,url=control.php?islem=kategoriliste");


                else:

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI</div></div>';
                    header("refresh:2,url=control.php?islem=katekle");


                endif;
            
            endif;
        
        endif;


        ?>

        <div class="container">
            <div class="row text-center">
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mx-auto mt-2">
                        
                        <form action="" method="POST">

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <input type="text"  name="katad" class="form-control" placeholder="Kategori Adı">
                        </div>				
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="KAYDET" class="btn btn-danger">
                        </div>
                        </form>

                        </div>					
                        
                        </div>
            
            
            </div>
            


        <?php

    }

    function katguncelle($katguncelledb){

        ?>

        <div class="container bg-light">
        <div class="row text-center">
            <div class="col-lg-10 col-md-10 col-xl-10 text-center mx-auto mt-2">

        <?php

        if(isset($_GET["id"])):

            $katgoster=$katguncelledb->prepare("SELECT * FROM kategoriler WHERE id=".$_GET["id"]);
            $katgoster->execute();
            $katgosterson=$katgoster->fetch(PDO::FETCH_ASSOC);

        endif;

        ?>

        <div class="container">
            <div class="row text-center">
                        <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
                        <form action="" method="POST">

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Kategori Ad</p></b>
                        <input type="text"  name="katad" class="form-control" value="<?php echo $katgosterson["kategoriad"]; ?>">
                        </div>					
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="Güncelle" class="btn btn-success">
                        <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                        </form></div>					
                        
                        </div>
            
            
            </div>
            
        </div>

        <?php

        if($_POST["buton"]):

            $katad=$_POST["katad"];
            $id=$_POST["kayit"];


            if(empty($katad)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
                header("refresh:2,url=control.php?islem=kategoriliste");


            else:

                $katguncel=$katguncelledb->prepare("UPDATE kategoriler SET 
                
                kategoriad=:kategoriad
                
                WHERE id=:id

                ");

                $katguncel->bindParam(":kategoriad",$katad);
                $katguncel->bindParam(":id",$id);


                if($katguncel->execute()):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">GÜNCELLENDİ</div></div>';
                    header("refresh:2,url=control.php?islem=kategoriliste");


                else:

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">GÜNCELLENMEDİ</div></div>';
                    header("refresh:2,url=control.php?islem=kategoriliste");


                endif;



            endif;

        endif;


        ?>

</div>
</div>
</div>

    <?php
    }

    function katsil($katsildb){

        $katsil=$katsildb->prepare("DELETE FROM kategoriler WHERE id=".$_GET["id"]);
        
        if($katsil->execute()):

            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">SİLİNDİ</div></div>';
            header("refresh:2,url=control.php?islem=kategoriliste");


        else:

            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">SİLİNMEDİ</div></div>';
            header("refresh:2,url=control.php?islem=kategoriliste");



        endif;

        

    }


}


class urunler {

    

    function listeurun($listeurundb){

        $stokalarm=$listeurundb->prepare("SELECT * FROM urunler");
        $stokalarm->execute();

        while($stokalarmson=$stokalarm->fetch(PDO::FETCH_ASSOC)):

            if($stokalarmson["cizgi"]>=$stokalarmson["stok"]): 

             echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger text-center"> '.$stokalarmson["adi"].' Ürünü Belirlene Stok Sınırının Altına İndi !  Stok Güncelleyin</div></div>';

            endif;

          endwhile;  

        $listeurun=$listeurundb->prepare("SELECT * FROM urunler");
        
        if($listeurun->execute()):
          

        ?>

            <div class="container">

                <div class="row text-center mt-1 text-center mx-auto ">

                <div class="col-lg-12 col-md-12 col-xl-12 mx-auto bg-light ">
                <a href="control.php?islem=urunekle" class="btn btn-success m-2 ">Ürün Ekle</a>
                <a href="control.php?islem=stoksinirliste" class="btn btn-danger m-2 ">Stok Sınırlar</a>
                <div>

        <form action="POST">
            <div class="col-lg-12 col-md-12 col-xl-12 mx-auto bg-light border border-secondary">
        
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-xl-2 text-center text-dark  font-weight-bold border-right border-bottom p-1" >AD</div>	
                        <div class="col-lg-2 col-md-2 col-xl-2 text-center text-dark  font-weight-bold border-right border-bottom p-1" >TURU</div>	
                        <div class="col-lg-1 col-md-1 col-xl-1 text-center text-dark  font-weight-bold border-right border-bottom p-1" >STOK</div>	
                        <div class="col-lg-1 col-md-1 col-xl-1 text-center text-dark  font-weight-bold border-right border-bottom p-1" >FİYAT</div>	
                        <div class="col-lg-4 col-md-4 col-xl-4 text-center text-dark  font-weight-bold border-right border-bottom p-1" >İŞLEMLER</div>	
                        <div class="col-lg-1 col-md-1 col-xl-2 text-center text-dark  font-weight-bold border-right border-bottom p-1" >Stok Sınır</div>	
                    </div>
                    
                    <div class="row">
                    
                    <?php 
                    
                    while($listeson=$listeurun->fetch(PDO::FETCH_ASSOC)):
                       
                    ?>

                        <div class="col-lg-2 col-md-2 col-xl-2 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $listeson["adi"]; ?></div>	
                        <div class="col-lg-2 col-md-2 col-xl-2 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $listeson["turu"]; ?></div>	
                        <div class="col-lg-1 col-md-1 col-xl-1 text-center text-dark  font-weight-bold border-right border-bottom p-1" >

                            <?php 
  
                                    echo $listeson["stok"];
                        
                            ?>
                            
                        </div>	
                        <div class="col-lg-1 col-md-1 col-xl-1 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $listeson["fiyat"]; ?></div>	
                        
                        <div class="col-lg-4 col-md-4 col-xl-4 text-center text-dark font-weight-bold border-right border-bottom p-1">
                            <a href="control.php?islem=urunsil&id=<?php echo $listeson["id"];?>" class="btn btn-danger btn-sm">Sil</a>
                            <a href="control.php?islem=urunguncelle&id=<?php echo $listeson["id"];?>" class="btn btn-success btn-sm">Güncelle</a>
                            <a href="control.php?islem=urunstokartır&id=<?php echo $listeson["id"];?>" class="btn btn-dark btn-sm">Stok Artır</a>
                            <a href="control.php?islem=urunstokazalt&id=<?php echo $listeson["id"];?>" class="btn btn-warning btn-sm">Stok Azalt</a>
                        </div>
                       
                        <div class="col-lg-2 col-md-2 col-xl-2 text-center text-dark font-weight-bold border-right border-bottom p-1" >
                            <?php if($listeson["cizgi"]==0):?>
                        <a href="control.php?islem=stoksınırekle&id=<?php echo $listeson["id"];?>" class="btn btn-info btn-sm">Ekle</a>
                            <?php else:  endif; ?>
                        <a href="control.php?islem=stoksınırguncelle&id=<?php echo $listeson["id"];?>" class="btn btn-info btn-sm">Güncelle</a>
                        </div>	

                        <?php 
                    
                        endwhile;
                       
                    endif;

                        ?>
                            
                    </div>
                                    
            </div>
        </form>

    </div>

</div>
</div>
</div>

          
        

        <?php
    }

    function urunekle($urunekledb){
		
		?>
		
		<div class="container bg-light">
        <div class="row text-center">
        <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">

        <?php

        if(@$_POST["buton"]):

            $urunadi=$_POST["urunadi"];
            $urunturu=$_POST["urunturu"];
            $urunstok=$_POST["urunstok"];
            $urunfiyat=$_POST["urunfiyat"];
            $bakiyestok=$_POST["urunstok"]*$_POST["urunfiyat"];
            $cizgi=0;
            $bildirim=0;

            if(empty($urunadi) || empty($urunturu) || empty($urunstok) || empty($urunfiyat)):

               echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ YER OLAMAZ </div></div>';
                header("refresh:2,url=control.php?islem=urunekle");

            else:

                $urunekle=$urunekledb->prepare("INSERT INTO urunler (adi,turu,stok,fiyat,cizgi,bildirim) VALUES (:adi,:turu,:stok,:fiyat,:cizgi,:bildirim)");

                $urunekle->bindParam(":adi",$urunadi);
                $urunekle->bindParam(":turu",$urunturu);
                $urunekle->bindParam(":stok",$urunstok);
                $urunekle->bindParam(":fiyat",$urunfiyat);
                $urunekle->bindParam(":cizgi",$cizgi);
                $urunekle->bindParam(":bildirim",$bildirim);

                if($urunekle->execute()):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">OLDU </div></div>';
                   
                    header("refresh:2,url=control.php?islem=listeurun");


                else:
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
             
                   
                    header("refresh:2,url=control.php?islem=urunekle");


                endif;
            
            endif;

            $kasagoster=$urunekledb->prepare("SELECT * FROM kasa");
            $kasagoster->execute();
            $kasagosterson=$kasagoster->fetch(PDO::FETCH_ASSOC);

            $bakiyeson=$kasagosterson["anapara"]-$bakiyestok; 

            $bakiyeguncel=$urunekledb->prepare("UPDATE kasa SET anapara=:anapara");

            $bakiyeguncel->bindParam(":anapara",$bakiyeson);

            if($bakiyeguncel->execute()):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">'.$bakiyestok.' : Adet Kasadan Düşüldü </div></div>';

            else:
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI !!!!!! </div></div>';

            endif;
        
        endif;

        $kategoriad=$urunekledb->prepare("select kategoriad from kategoriler");
        
        $kategoriad->execute();
        
        ?>

                        <form action="" method="POST">

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <input type="text"  name="urunadi" class="form-control" placeholder="Ürün Adı">
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <input type="text"  name="urunstok" class="form-control" placeholder="Ürün Stok Durumu">
                        </div>	
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <input type="text"  name="urunfiyat" class="form-control" placeholder="Ürün Fiyatı">
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1 text-danger font-weight-bold">
                            KATEGORİ 
                            <select name="urunturu" class="form-control">
                            <option>Seçiniz</option>
                                <?php while($kategorison=$kategoriad->fetch(PDO::FETCH_ASSOC)): ?>

                                <option><?php echo $kategorison["kategoriad"]; ?></option>
                            
                              <?php  endwhile; ?>
                            </select> 
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="KAYDET" class="btn btn-danger">
                        </div>
                        </form>
                        
                        </div>					
                        
                        </div>
            
            </div>
            
          </div>


        <?php

    }

    function urunguncelle($urunguncelledb){
		
		?>
		
		  <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
		
		<?php

        if(@isset($_GET["id"])):

            $urungoster=$urunguncelledb->prepare("SELECT * FROM urunler WHERE id=".$_GET["id"]);
            $urungoster->execute();
            $urungosterson=$urungoster->fetch(PDO::FETCH_ASSOC);

        endif;

        $kategoriguncelle=$urunguncelledb->prepare("select * from kategoriler");
        
        $kategoriguncelle->execute();
        

        ?>

      
                        <form action="" method="POST">

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Ürün Adı</p></b>
                        <input type="text" name="urunadi" class="form-control" value="<?php echo $urungosterson["adi"]; ?>">
                        </div>	
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Ürün Fiyatı</p></b>
                        <input type="text" name="urunfiyat" class="form-control" value="<?php echo $urungosterson["fiyat"]; ?>">
                        </div>	

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                            <b>KATEGORİ </b>
                            <select name="urunturu" class="form-control">

                                <?php while($kategorison=$kategoriguncelle->fetch(PDO::FETCH_ASSOC)): ?>
                                
                                <option <?php if($urungosterson["turu"]==$kategorison["kategoriad"]): ?> selected <?php endif; ?> ><?php echo $kategorison["kategoriad"]; ?></option>
                            
                                <?php endwhile; ?>

                            </select> 
                        </div>	
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="Güncelle" class="btn btn-danger">
                        <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                        </form>
                    </div>					
                        
       

        <?php

        if(@$_POST["buton"]):

            $urunad=$_POST["urunadi"];
            $uruntur=$_POST["urunturu"];
            $urunfiyat=$_POST["urunfiyat"];
            $bakiye=$_POST["urunfiyat"]-$urungosterson["fiyat"];
            $kasa=$urungosterson["stok"]*abs($bakiye);
            $id=$_POST["kayit"];


            if(empty($urunad) || empty($uruntur) || empty($urunfiyat)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
                header("refresh:2,url=control.php?islem=listeurun");

            else:

                $urunguncel=$urunguncelledb->prepare("UPDATE urunler SET 
                
                adi=:adi,
                turu=:turu,
                fiyat=:fiyat
                
                WHERE id=:id

                ");

                $urunguncel->bindParam(":adi",$urunad);
                $urunguncel->bindParam(":turu",$uruntur);
                $urunguncel->bindParam(":fiyat",$urunfiyat);
                $urunguncel->bindParam(":id",$id);


                if($urunguncel->execute()):
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">Güncellendi </div></div>';
                   
                    header("refresh:2,url=control.php?islem=listeurun");


                else:
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                    
                    header("refresh:2,url=control.php?islem=listeurun");


                endif;

            $kasagoster=$urunguncelledb->prepare("SELECT * FROM kasa");
            $kasagoster->execute();
            $kasagosterson=$kasagoster->fetch(PDO::FETCH_ASSOC);
            
            if($_POST["urunfiyat"]>$urungosterson["fiyat"]):

            $bakiyeson=$kasagosterson["anapara"]-$kasa; 

            $bakiyeguncel=$urunguncelledb->prepare("UPDATE kasa SET anapara=:anapara");

            $bakiyeguncel->bindParam(":anapara",$bakiyeson);

            if($bakiyeguncel->execute()):

            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">'.$kasa.' : Adet Kasadan Düşüldü </div></div>';

            else:

            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI !!!!!! </div></div>';

            endif;

            elseif($_POST["urunfiyat"]<$urungosterson["fiyat"]):

                $bakiyeson=$kasagosterson["anapara"]+$kasa; 

                $bakiyeguncel=$urunguncelledb->prepare("UPDATE kasa SET anapara=:anapara");
    
                $bakiyeguncel->bindParam(":anapara",$bakiyeson);
    
                if($bakiyeguncel->execute()):
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">'.$kasa.' : Adet Kasadan Eklendi </div></div>';
    
                else:
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI !!!!!! </div></div>';
    
                endif;

            else:

                echo "olmadı";

            endif;

            endif;

        endif;
?>


                 </div>
            
            
            </div>
            
        </div>

<?php


    }

    function urunsil($urunsildb){

        if(isset($_GET["id"])):

            $urungoster=$urunsildb->prepare("SELECT * FROM urunler WHERE id=".$_GET["id"]);
            $urungoster->execute();
            $urungosterson=$urungoster->fetch(PDO::FETCH_ASSOC);

        endif;

        $bakiyestok=$urungosterson["fiyat"]*$urungosterson["stok"];

        $urunsil=$urunsildb->prepare("DELETE FROM urunler WHERE id=".$_GET["id"]);
        
        if($urunsil->execute()):

            $kasagoster=$urunsildb->prepare("SELECT * FROM kasa");
            $kasagoster->execute();
            $kasagosterson=$kasagoster->fetch(PDO::FETCH_ASSOC);
    
            $bakiyeson=$kasagosterson["anapara"]+$bakiyestok; 
    
            $bakiyeguncel=$urunsildb->prepare("UPDATE kasa SET anapara=:anapara");
    
            $bakiyeguncel->bindParam(":anapara",$bakiyeson);
    
            if($bakiyeguncel->execute()):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">'.$bakiyestok.' : Adet Kasadan Eklendi </div></div>';
    
            else:
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI !!!!!! </div></div>';
    
            endif;
            
            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">SİLİNDİ </div></div>';
           
            header("refresh:2,url=control.php?islem=listeurun");

        else:
            
            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">SİLİNEMEDİ </div></div>';
         
            header("refresh:2,url=control.php?islem=listeurun");

        endif;

      

        

    }


}


class stokguncelle {


    function urunstokartır($urunguncelleartırdb){
		
        ?>
		
		  <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
		
        <?php
        
            

        if(isset($_GET["id"])):

            $urungoster=$urunguncelleartırdb->prepare("SELECT * FROM urunler WHERE id=".$_GET["id"]);
            $urungoster->execute();
            $urungosterson=$urungoster->fetch(PDO::FETCH_ASSOC);

        endif;

      
        ?>
  
                <form action="" method="POST">

                <h4 class="text-danger">Stok Artır</h4>

                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                <b><p>Ürün Adı</p></b>
                <p class="text-success font-weight-bold"><?php echo $urungosterson["adi"]; ?></p>
                </div>
                
                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                <b><p>Ürün Adı</p></b>
                <p class="text-success font-weight-bold"><?php echo $urungosterson["turu"]; ?></p>
                </div>

                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                <b><p>Ürün Stok</p></b>
                <input type="number" name="urunstok" min="0" class="form-control">
                </div>
                <br>
                <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                <input type="submit" name="buton" value="Artır" class="btn btn-danger">
                <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                </form>
                </div>					
                        


        <?php

            $kasagoster=$urunguncelleartırdb->prepare("SELECT * FROM kasa");
            $kasagoster->execute();
            $kasagosterson=$kasagoster->fetch(PDO::FETCH_ASSOC);

        if(@$_POST["buton"]):

            $urunstok=$urungosterson["stok"]+$_POST["urunstok"];
            $bakiyestok=$urungosterson["fiyat"]*$_POST["urunstok"];
            $id=$_POST["kayit"];
            $sifir=0;
            $bir=1;

            if(empty($urunstok)):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
              
                header("refresh:2,url=control.php?islem=listeurun");


            else:

                $urunguncel=$urunguncelleartırdb->prepare("UPDATE urunler SET stok=:stok WHERE id=:id");

                $urunguncel->bindParam(":stok",$urunstok);
                $urunguncel->bindParam(":id",$id);


                if($urunguncel->execute()):
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">'.$_POST["urunstok"]. ' : Adet Stok Eklendi </div></div>';
                   
                    header("refresh:2,url=control.php?islem=listeurun");


                else:
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                
                    header("refresh:2,url=control.php?islem=listeurun");


                endif;

            endif;


            $artır=$_POST["urunstok"];
            $azalt=0;
            $tarih=date('Y-m-d H:i:s');

            $stokartırlog=$urunguncelleartırdb->prepare("INSERT INTO rapor(urun,kate,cikis,giris,zaman) VALUES (:urun,:kate,:cikis,:giris,:zaman)");

            $stokartırlog->bindParam(":urun",$urungosterson["adi"]);
            $stokartırlog->bindParam(":kate",$urungosterson["turu"]);
            $stokartırlog->bindParam(":cikis",$azalt);
            $stokartırlog->bindParam(":giris",$artır);
            $stokartırlog->bindParam(":zaman",$tarih);

            $stokartırlog->execute();

            $stokartırlog=$urunguncelleartırdb->prepare("INSERT INTO stok(urunadi,azaltma,artirma,tarih) VALUES (:urunadi,:azaltma,:artirma,:tarih)");

            $stokartırlog->bindParam(":urunadi",$urungosterson["adi"]);
            $stokartırlog->bindParam(":artirma",$artır);
            $stokartırlog->bindParam(":azaltma",$azalt);
            $stokartırlog->bindParam(":tarih",$tarih);

            if($stokartırlog->execute()):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">OLDU </div></div>';                

            else:
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                

            endif;

            if($urungosterson["cizgi"]<$urungosterson["stok"] || $urungosterson["cizgi"]==$urungosterson["stok"]):

                $stokcokbildirim=$urunguncelleartırdb->prepare("UPDATE urunler SET bildirim=:bildirim WHERE adi=:adi");
                $stokcokbildirim->bindParam(":bildirim",$bir);
                $stokcokbildirim->bindParam(":adi",$urungosterson["adi"]);

                $stokcokbildirim->execute();

            endif; 

            if($urungosterson["cizgi"]>$urungosterson["stok"] || $urungosterson["cizgi"]==$urungosterson["stok"]):

                $stokcokbildirimyeni=$urunguncelleartırdb->prepare("UPDATE urunler SET bildirim=:bildirim WHERE adi=:adi");
                $stokcokbildirimyeni->bindParam(":bildirim",$sifir);
                $stokcokbildirimyeni->bindParam(":adi",$urungosterson["adi"]);

                $stokcokbildirimyeni->execute();

            endif;

            $bakiyeson=$kasagosterson["anapara"]-$bakiyestok; 

            $bakiyeguncel=$urunguncelleartırdb->prepare("UPDATE kasa SET anapara=:anapara");

            $bakiyeguncel->bindParam(":anapara",$bakiyeson);

            if($bakiyeguncel->execute()):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">'.$bakiyestok.' : Adet Kasadan Düşüldü </div></div>';

            else:
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI !!!!!! </div></div>';

            endif;

            

        endif;
				
				?>
				
				
				</div>
            
            </div>
            
        </div>
				<?php


    }

    function urunstokazalt($urunguncelleazaltdb){
			?>
		
		  <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
		
		<?php

        if(isset($_GET["id"])):

            $urungoster=$urunguncelleazaltdb->prepare("SELECT * FROM urunler WHERE id=".$_GET["id"]);
            $urungoster->execute();
            $urungosterson=$urungoster->fetch(PDO::FETCH_ASSOC);

        endif;

      
        ?>

                        <form action="" method="POST">

                        <h4 class="text-danger">Stok Azalt</h4>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p >Ürün Adı</p></b>
                        <p class="text-success font-weight-bold"><?php echo $urungosterson["adi"]; ?></p>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Ürün Adı</p></b>
                        <p class="text-success font-weight-bold"><?php echo $urungosterson["turu"]; ?></p>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Ürün Stok</p></b>
                        <input type="number" name="urunstok" class="form-control">
                        </div>
                        <br>
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="Azalt" class="btn btn-danger">
                        <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                        </form></div>					
                        
        

        <?php

        $kasagoster=$urunguncelleazaltdb->prepare("SELECT * FROM kasa");
        $kasagoster->execute();
        $kasagosterson=$kasagoster->fetch(PDO::FETCH_ASSOC);

        if(@$_POST["buton"]):

            $urunstok=$urungosterson["stok"]-$_POST["urunstok"];
            $bakiyestok=$urungosterson["fiyat"]*$_POST["urunstok"];
            $id=$_POST["kayit"];
            $sifir=0;
            $bir=1;


            if(empty($urunstok)):

             echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
                header("refresh:2,url=control.php?islem=listeurun");


            else:

                $urunguncel=$urunguncelleazaltdb->prepare("UPDATE urunler SET stok=:stok WHERE id=:id ");

                $urunguncel->bindParam(":stok",$urunstok);
                $urunguncel->bindParam(":id",$id);


                if($urunguncel->execute()):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">'.$_POST["urunstok"].' : Adet Stok Çıkarıldı </div></div>';
                   
                    header("refresh:2,url=control.php?islem=listeurun");


                else:

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI</div></div>';

                endif;

            $artır=0;
            $azalt=$_POST["urunstok"];
            $tarih=date('Y-m-d H:i:s');

            $stokartırlog=$urunguncelleazaltdb->prepare("INSERT INTO rapor(urun,kate,cikis,giris,zaman) VALUES (:urun,:kate,:cikis,:giris,:zaman)");

            $stokartırlog->bindParam(":urun",$urungosterson["adi"]);
            $stokartırlog->bindParam(":kate",$urungosterson["turu"]);
            $stokartırlog->bindParam(":cikis",$azalt);
            $stokartırlog->bindParam(":giris",$artır);
            $stokartırlog->bindParam(":zaman",$tarih);

            $stokartırlog->execute();

            $stokartırlog=$urunguncelleazaltdb->prepare("INSERT INTO stok(urunadi,azaltma,artirma,tarih) VALUES (:urunadi,:azaltma,:artirma,:tarih)");

            $stokartırlog->bindParam(":urunadi",$urungosterson["adi"]);
            $stokartırlog->bindParam(":artirma",$artır);
            $stokartırlog->bindParam(":azaltma",$azalt);
            $stokartırlog->bindParam(":tarih",$tarih);

            if($stokartırlog->execute()):

              echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">OLDU </div></div>';

            else:

             echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';

            endif;

            endif;

            if($urungosterson["cizgi"]<$urungosterson["stok"] || $urungosterson["cizgi"]==$urungosterson["stok"]):

                $stokazbildirim=$urunguncelleazaltdb->prepare("UPDATE urunler SET bildirim=:bildirim WHERE adi=:adi");
                $stokazbildirim->bindParam(":bildirim",$bir);
                $stokazbildirim->bindParam(":adi",$urungosterson["adi"]);

                $stokazbildirim->execute();

            endif; 

            if($urungosterson["cizgi"]>$urungosterson["stok"] || $urungosterson["cizgi"]==$urungosterson["stok"]):

                $stokazbildirimyeni=$urunguncelleazaltdb->prepare("UPDATE urunler SET bildirim=:bildirim WHERE adi=:adi");
                $stokazbildirimyeni->bindParam(":bildirim",$sifir);
                $stokazbildirimyeni->bindParam(":adi",$urungosterson["adi"]);

                $stokazbildirimyeni->execute();

            endif;

            $bakiyeson=$kasagosterson["anapara"]+$bakiyestok; 

            $bakiyeguncel=$urunguncelleazaltdb->prepare("UPDATE kasa SET anapara=:anapara");

            $bakiyeguncel->bindParam(":anapara",$bakiyeson);

            if($bakiyeguncel->execute()):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">'.$bakiyestok.' : Adet Kasadan Eklendi </div></div>';

            else:
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI !!!!!! </div></div>';

            endif;

        endif;
				
				?>
				
				</div>
            
            </div>
            
        </div>
				<?php

    }



}

class rapor {

    function stokrapor($raporgetirdb){

        ?>

        <div class="contanier bg-light">
        <div class="row text-center">

        <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">

        <?php

        $raporgetir=$raporgetirdb->prepare("SELECT * FROM urunler");
        $raporgetir->execute();
        //$raporgetirson=$raporgetir->fetch(PDO::FETCH_ASSOC);

        $raporkatgetir=$raporgetirdb->prepare("SELECT * FROM kategoriler");
        $raporkatgetir->execute();

        ?>
                        
                        <form action="" method="POST">

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center text-danger mt-1">
                            <b>Ürün Kategori</b>
                            <select name="kateler" class="form-control">
                                <option value="katbos" >Seçiniz</option>
                                <?php while($raporkatgetirson=$raporkatgetir->fetch(PDO::FETCH_ASSOC)): ?>
                                <option><?php echo $raporkatgetirson["kategoriad"]; ?></option>
                                <?php endwhile; ?>
                            </select> 
                        </div>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center text-danger mt-1">
                            <b>Ürün Adı </b>
                            <select name="urunleradi" class="form-control">
                                <option value="urunbos">Seçiniz</option>
                                <?php while($raporgetirson=$raporgetir->fetch(PDO::FETCH_ASSOC)): ?>
                                <option><?php echo $raporgetirson["adi"].' ('.$raporgetirson["turu"].')'; ?></option>
                                <?php endwhile; ?>
                            </select> 
                        </div> 

                     <div class="col-lg-12 col-md-12 col-xl-12 text-center text-danger mt-1">
                        <b>Stok Hareketleri </b>
                        <select name="stokhareket" class="form-control">
                            <option>Seçiniz</option>
                            <option value="stokgiris">Stok Giriş</option>
                            <option value="stokcikis">Stok Çıkış</option>
                            <option value="stokhepsi">Tüm Hareketler</option>
                        </select> 
                    </div> 
                         
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center text-danger mt-1">
                        <b>Stok Değişim Tarih </b>
                        <input type="date" class="form-control" name="tarih">
                        </div>	
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="Göster" class="btn btn-danger">
                        </form>
        
            </div>

            </div>
        </div>
        </div>
        

       <?php

        if(@$_POST["buton"]):

            $urunleradi=$_POST["urunleradi"];
            $kateler=$_POST["kateler"];
            $tarih=$_POST["tarih"];

            if(empty($tarih)):

            if($_POST["kateler"]=="katbos"): 

            $urunrapor=$raporgetirdb->prepare("SELECT * FROM rapor WHERE urun=:urun");
            $urunrapor->bindParam(":urun",$urunleradi);
            $urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC);
            
            if($urunrapor->execute()):

                    if(@$_POST["stokhareket"]=="stokcikis"):

                        //echo $_POST["urunleradi"]." ürünü çıkış sayıları :";

                    while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                        if($urunraporson["cikis"]==0):

                        else:

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["urunleradi"].' '.$urunraporson["cikis"].' Çıkış </div></div>';

                        endif;

                    endwhile;

                    endif;

                    if(@$_POST["stokhareket"]=="stokgiris"):

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):
    
                            if($urunraporson["giris"]==0):

                            else:
                                
                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["urunleradi"].' '.$urunraporson["giris"].' Giriş </div></div>';

                            endif;
    
                        endwhile;
    
                    endif;

                    if(@$_POST["stokhareket"]=="stokhepsi"):

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                            if($urunraporson["giris"]==0):

                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$urunraporson["zaman"].' '.$_POST["urunleradi"].' '.$urunraporson["giris"].' Giriş <br> </div></div>';

                            endif;

                            if($urunraporson["cikis"]==0):

                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$urunraporson["zaman"].' '.$_POST["urunleradi"].' '.$urunraporson["cikis"].' Çıkış <br> </div></div>';

                            endif;

                        endwhile;
    
                    endif;

                
            else:

                echo "olmadı";

            endif;

        endif;

        if($_POST["urunleradi"]=="urunbos"): 

            $urunrapor=$raporgetirdb->prepare("SELECT * FROM rapor WHERE kate=:kate");
            $urunrapor->bindParam(":kate",$kateler);
            $urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC);
            
            if($urunrapor->execute()):

                    if(@$_POST["stokhareket"]=="stokcikis"):

                        //echo $_POST["urunleradi"]." ürünü çıkış sayıları :";

                    while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                        if($urunraporson["cikis"]==0):

                        else:

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["kateler"].' '.$urunraporson["cikis"].' Çıkış </div></div>';

                        endif;

                    endwhile;

                    endif;

                    if(@$_POST["stokhareket"]=="stokgiris"):

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):
    
                            if($urunraporson["giris"]==0):

                            else:
                                
                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["kateler"].' '.$urunraporson["giris"].' Giriş </div></div>';

                            endif;
    
                        endwhile;
    
                    endif;

                    if(@$_POST["stokhareket"]=="stokhepsi"):

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                            if($urunraporson["giris"]==0):

                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$urunraporson["zaman"].' '.$_POST["kateler"].' '.$urunraporson["giris"].' Giriş <br> </div></div>';

                            endif;

                            if($urunraporson["cikis"]==0):

                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$urunraporson["zaman"].' '.$_POST["kateler"].' '.$urunraporson["cikis"].' Çıkış <br> </div></div>';

                            endif;

                        endwhile;
    
                    endif;

            else:

                echo "olmadı";

            endif;

        endif;


            $urunrapor=$raporgetirdb->prepare("SELECT * FROM rapor WHERE kate=:kate and urun=:urun");
            $urunrapor->bindParam(":kate",$kateler);
            $urunrapor->bindParam(":urun",$urunleradi);
            $urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC);
            
            if($urunrapor->execute()):

                    if(@$_POST["stokhareket"]=="stokcikis"):

                        //echo $_POST["urunleradi"]." ürünü çıkış sayıları :";

                    while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                        if($urunraporson["cikis"]==0):

                        else:

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["kateler"].' '.$urunraporson["cikis"].' Çıkış </div></div>';

                        endif;

                    endwhile;

                    endif;

                    if(@$_POST["stokhareket"]=="stokgiris"):

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):
    
                            if($urunraporson["giris"]==0):

                            else:
                                
                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["kateler"].' '.$urunraporson["giris"].' Giriş </div></div>';

                            endif;
    
                        endwhile;
    
                    endif;

                    if(@$_POST["stokhareket"]=="stokhepsi"):

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                            if($urunraporson["giris"]==0):

                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$urunraporson["zaman"].' '.$_POST["kateler"].' '.$urunraporson["giris"].' Giriş <br> </div></div>';

                            endif;

                            if($urunraporson["cikis"]==0):

                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$urunraporson["zaman"].' '.$_POST["kateler"].' '.$urunraporson["cikis"].' Çıkış <br> </div></div>';

                            endif;

                        endwhile;
    
                    endif;

            else:

                echo "olmadı";

            endif;

        else:

            $urunraporzaman=$raporgetirdb->prepare("SELECT * FROM rapor");
            $urunraporzaman->execute();
            $urunraporzamanson=$urunraporzaman->fetch(PDO::FETCH_ASSOC);

            $urunrapor=$raporgetirdb->prepare("SELECT * FROM rapor WHERE urun=:urun and zaman=:tarih");
            $urunrapor->bindParam(":urun",$urunleradi);
            $urunrapor->bindParam(":tarih",$tarih);
            
            if($urunrapor->execute()):

                    if($_POST["stokhareket"]=="stokcikis"):

                        if($_POST["tarih"]!=$urunraporzamanson["zaman"]):

                            echo "Seçili Tarihe Ait Çıkış Verisi Bulunamadı";
        
                        else:

                    while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["tarih"].' '.$_POST["urunleradi"].' '.$urunraporson["cikis"].' Çıkış <br></div></div>'; 

                    endwhile;

                        endif;
    
                    endif;

                    if(@$_POST["stokhareket"]=="stokgiris"):

                        if($_POST["tarih"]!=$urunraporzamanson["zaman"]):

                            echo "Seçili Tarihe Ait Giriş Verisi Bulunamadı";
        
                        else:

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):
    
                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["tarih"].' '.$_POST["urunleradi"].' '.$urunraporson["giris"].' Giriş <br> </div></div>';

                            echo " ".$urunraporson["giris"]."/";
    
                        endwhile;

                        endif;
    
                    endif;

                    if(@$_POST["stokhareket"]=="stokhepsi"):

                        if($_POST["tarih"]!=$urunraporzamanson["zaman"]):

                            echo "Seçili Tarihe Ait Veri Bulunamadı";
        
                        else:

                        while($urunraporson=$urunrapor->fetch(PDO::FETCH_ASSOC)):

                            if($urunraporson["giris"]==0):
                            
                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["tarih"].' '.$_POST["urunleradi"].' '.$urunraporson["giris"].' Giriş <br> </div></div>';

                            endif;

                            if($urunraporson["cikis"]==0):

                            else:

                            echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success text-center">'.$_POST["tarih"].' '.$_POST["urunleradi"].' '.$urunraporson["cikis"].' Çıkış <br> </div></div>';
    
                            endif;

                        endwhile;

                        endif;
    
                    endif;

            else:

                echo "olmadı";


            endif;

            endif;


        ?>

        <?php

        endif;
    }

}


class yetkiler {

    function giriskontrol($yonetimgirisdb){
        
        if($_POST):


            $rand=substr(md5(microtime()),rand(0,26),8);

            $kulad=$_POST["kulad"];
            $sifre=$_POST["sifre"];
            $yetki=$_POST["yetki"];
    
            if(empty($kulad) || empty($sifre) || empty($yetki)):
    
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ YER KALAMAZ !!! </div></div>';
                header("refresh:2,url=index.php");

            else:

              $giris=$yonetimgirisdb->prepare("SELECT * FROM kullanici WHERE kulad=:kulad && yetki=:yetki && sifre=:sifre");
              $giris->bindParam(":kulad",$kulad);
              $giris->bindParam(":sifre",md5(sha1(md5($_POST["sifre"])))); 
              $giris->bindParam(":yetki",$yetki);
              $giris->execute();
              $girisson=$giris->fetch(PDO::FETCH_ASSOC);

              $sifregetir=$yonetimgirisdb->prepare("SELECT * FROM kullanici where yetki=:yetki");
              $sifregetir->bindParam(":yetki",$yetki);
              $sifregetir->execute();
              $sifregetirson=$sifregetir->fetch(PDO::FETCH_ASSOC);
              

              if($sifregetirson["sifre"]!==$sifregetirson["sifre2"] && md5(sha1(md5($_POST["sifre"])))==$sifregetirson["sifre2"]):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">Şifreniz Sıfırlandı Şifrenizi Değiştirin</div></div>'; 
                header("refresh:2,url=sifreyenile.php?yeni=sifreyenile&id=".$yetki);

              else:

              if($sifregetirson["sifre"]==md5(sha1(md5($_POST["sifre"]))) && $sifregetirson["kulad"]==$kulad && $sifregetirson["yetki"]==$yetki):

                $_SESSION["kulad"]=$kulad;
                $_SESSION["sifre"]=$sifre;
                $_SESSION["yetki"]=$yetki;
    
                    if($girisson["yetki"]==1):

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">Yetkili Hoş geldiniz </div></div>'; 
                        header("refresh:2,url=control.php?islem=anasayfa");

                        elseif($girisson["yetki"]==2):

                        echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">Depo görevlisi hoş geldiniz</div></div>';
                        header("refresh:2,url=control.php?islem=anasayfa");

                        elseif($girisson["yetki"]==3):

	                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">Kasiyer hoş geldiniz</div></div>';
						header("refresh:2,url=control.php?islem=anasayfa");

                    endif;

                    else:

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
                    <div class="alert alert-danger">BÖYLE BİR KULLANICI YOK !!! </div></div>';
                    header("refresh:2,url=index.php");
                    endif;
              
            endif;
            endif;

            
          else:
    
            ?>
								<div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="text"  class="form-control form-control-user" name="kulad" placeholder="Kullanıcı Adınız...">
                                        </div>
                                </div>	
										
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="sifre"  placeholder="Şifreniz....">
                                    </div>
                                </div>	
										
                                <div class="col-xl-12 col-lg-12 col-md-12">
							        <div class="form-group">
                                        <select name="yetki" class="form-control">
                                            <option value="1">Yönetici</option>
                                            <option value="2">Depo Görevlisi</option>
                                            <option value="3">Kasiyer</option>
                                        </select> 
                                    </div>
                                </div>	
										
                                        
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="GİRİŞ">
										<a href="sifreyenile.php">Şifre Yenileme</a>
                                     </form>
                                </div>	
										
    
            <?php

    
          endif;


    }

    function sifreyenile($sifreyeniledb){

        ?>

        <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">


        <?php

        if(isset($_GET["id"])):

            $sifreyenilegetir=$sifreyeniledb->prepare("SELECT * FROM kullanici WHERE yetki=".$_GET["id"]);
            $sifreyenilegetir->execute();

        endif;

        ?>

                <form class="user" action="" method="POST">
                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                    <h3 class="col-lg-12 col-md-12 col-xl-12 text-center mt-1" >Şifre Yenileme</h3>
                </div>
                    <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                      <input type="password" class="form-control" name="yenisifre"  placeholder="Yeni Şifreniz....">
                    </div>
                    <br> 
                    <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                    <input type="submit" name="buton" class="btn btn-primary btn-user btn-block" value="GİRİŞ">
                    <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                    </div>
                </form>


        </div>
        </div>
        </div>

        <?php

         if($_POST):

            $yenisifre=$_POST["yenisifre"];
            $yetki=$_POST["kayit"];

            if(empty($yenisifre)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA</div></div>'; 

            else:

                $sifreyenileme=$sifreyeniledb->prepare("UPDATE kullanici SET sifre=:sifre WHERE yetki=:yetki");
                $sifreyenileme->bindParam(":sifre",md5(sha1(md5($_POST["yenisifre"]))));
                $sifreyenileme->bindParam(":yetki",$yetki);

                if($sifreyenileme->execute()):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">Şifreneiz Yenilendi Giriş Yapabilirsiniz !!</div></div>'; 
                    header("refresh:2,url=index.php");

                else:

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI</div></div>'; 

                endif;

            endif;

        endif;

    }

}

class stokalarm{

    function stoksinirliste($stoksinirlistedb){

        $stoksinir=$stoksinirlistedb->prepare("SELECT * FROM alarm");

        if($stoksinir->execute()):

        ?>

    <div class="container">

        <div class="row text-center mt-1 bg-light text-center mx-auto ">        

            <div class="col-lg-6 col-md-6 col-xl-6 mx-auto bg-light border border-secondary">
        
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xl-6 text-center text-danger  font-weight-bold border-right border-bottom p-1" >AD</div>	
                        <div class="col-lg-6 col-md-6 col-xl-6 text-center text-danger  font-weight-bold border-right border-bottom p-1" >STOK SINIR</div>		
                    </div>
                    
                    <div class="row">

                <?php 

                while($stoksinirson=$stoksinir->fetch(PDO::FETCH_ASSOC)):

                    ?>

                        <div class="col-lg-6 col-md-6 col-xl-6 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $stoksinirson["ad"]; ?></div>	
                        <div class="col-lg-6 col-md-6 col-xl-6 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $stoksinirson["sinir"]; ?></div>

                    <?php
                
                endwhile;

                endif;

                ?>
                
                </div>
                                        
                </div>
                            
                </div>
                            
                </div>

                <?php 
    }

    function stoksınırekle($stoksınırekledb){

        ?>
		
		  <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
		
        <?php
        
        if(isset($_GET["id"])):

            $urungoster=$stoksınırekledb->prepare("SELECT * FROM urunler WHERE id=".$_GET["id"]);
            $urungoster->execute();
            $urungosterson=$urungoster->fetch(PDO::FETCH_ASSOC);

        endif;
                
                $alarmstok=$stoksınırekledb->prepare("SELECT * FROM alarm");
                $alarmstok->execute();
                $alarmstokson=$alarmstok->fetchAll(PDO::FETCH_COLUMN,1);
    

    ?>
                        
                        <form action="" method="POST">

                        <h4 class="text-danger">Stok Alt Sınır Ekle</h4>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Ürün Adı</p></b>
                        <p class="text-success font-weight-bold"><?php echo $urungosterson["adi"]; ?></p>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Ürün Adı</p></b>
                        <p class="text-success font-weight-bold"><?php echo $urungosterson["turu"]; ?></p>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                        <b><p>Ürün Stok</p></b>
                        <input type="number" name="stoksınır" min="0" class="form-control">
                        </div>
                        <br>
                        <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                        <input type="submit" name="buton" value="Ekle" class="btn btn-danger">
                        <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                        </form>
                    </div>					
                        
        <?php


        if(@$_POST["buton"]):

            if(in_array($urungosterson["adi"],$urungosterson["turu"],$alarmstokson)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">'.$urungosterson["adi"].' Ürüne Ait Sınır Var </div></div>';
        
                header("refresh:2,url=control.php?islem=listeurun");

            else:

            $stoksınır=$_POST["stoksınır"];
            $id=$_POST["kayit"];

            if(empty($stoksınır)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';

                header("refresh:2,url=control.php?islem=listeurun");

            else:

                $urunguncel=$stoksınırekledb->prepare("UPDATE urunler SET cizgi=:cizgi WHERE id=:id");
                $urunguncel->bindParam(":cizgi",$stoksınır);
                $urunguncel->bindParam(":id",$id);

                $urunguncel->execute();

                $stoksınırekle=$stoksınırekledb->prepare("INSERT INTO alarm(ad,sinir,alarmkat) VALUES (:ad,:sinir,:alarmkat)");
                $stoksınırekle->bindParam(":ad",$urungosterson["adi"]);
                $stoksınırekle->bindParam(":alarmkat",$urungosterson["turu"]);
                $stoksınırekle->bindParam(":sinir",$stoksınır);

                if($stoksınırekle->execute()):

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">OLDU </div></div>'; 
                    header("refresh:2,url=control.php?islem=listeurun");
               

                else:

                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                    header("refresh:2,url=control.php?islem=listeurun");


                endif;


            endif;

        endif;

        endif;


    }

    function stoksınırguncelle($stoksınırguncelle){

        ?>
		
		  <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
		
        <?php
    

        if(isset($_GET["id"])):

            $urungoster=$stoksınırguncelle->prepare("SELECT * FROM urunler WHERE id=".$_GET["id"]);
            $urungoster->execute();
            $urungosterson=$urungoster->fetch(PDO::FETCH_ASSOC);

        endif;

      
        ?>

            
            <form action="" method="POST">

            <h4 class="text-danger">Stok Alt Sınır Güncelle</h4>

            <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
            <b><p>Ürün Adı</p></b>
            <p class="text-success font-weight-bold"><?php echo $urungosterson["adi"]; ?></p>
            </div>	

            <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
            <b><p>Ürün Stok</p></b>
            <input type="number" name="stokalt" min="0" value="<?php echo $urungosterson["cizgi"]; ?>" class="form-control">
            </div>
            <br>
            <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
            <input type="submit" name="buton" value="Güncelle" class="btn btn-danger">
            <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
            </form>
            </div>					

            <?php

            if(@$_POST["buton"]):

                $altstok=$_POST["stokalt"];
                $sifir=0;
                $bir=1;

                if(empty($altstok)):

                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
              
                header("refresh:2,url=control.php?islem=listeurun");

                else:

                $stokalturun=$stoksınırguncelle->prepare("UPDATE urunler SET cizgi=:cizgi WHERE adi=:adi");

                $stokalturun->bindParam(":cizgi",$altstok);
                $stokalturun->bindParam(":adi",$urungosterson["adi"]);

                $stokalturun->execute();

                $stokaltsınır=$stoksınırguncelle->prepare("UPDATE alarm SET sinir=:sinir WHERE ad=:ad");

                $stokaltsınır->bindParam(":sinir",$altstok);
                $stokaltsınır->bindParam(":ad",$urungosterson["adi"]);

                if($stokaltsınır->execute()):
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">OLDU</div></div>';
                   
                    header("refresh:2,url=control.php?islem=listeurun");

                else:
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                
                    header("refresh:2,url=control.php?islem=listeurun");

                endif;


                if($urungosterson["cizgi"]<$urungosterson["stok"] || $urungosterson["cizgi"]==$urungosterson["stok"]):

                    $stokguncelbildirim=$stoksınırguncelle->prepare("UPDATE urunler SET bildirim=:bildirim WHERE adi=:adi");
                    $stokguncelbildirim->bindParam(":bildirim",$bir);
                    $stokguncelbildirim->bindParam(":adi",$urungosterson["adi"]);
    
                    $stokguncelbildirim->execute();
    
                endif; 
    
                if($urungosterson["cizgi"]>$urungosterson["stok"] || $urungosterson["cizgi"]==$urungosterson["stok"]):
    
                    $stokguncelbildirimyeni=$stoksınırguncelle->prepare("UPDATE urunler SET bildirim=:bildirim WHERE adi=:adi");
                    $stokguncelbildirimyeni->bindParam(":bildirim",$sifir);
                    $stokguncelbildirimyeni->bindParam(":adi",$urungosterson["adi"]);
    
                    $stokguncelbildirimyeni->execute();
    
                endif;


                endif;   


            endif;
    }

}

class kasa{

    function anaparaliste($anaparaliste){

        $listeanapara=$anaparaliste->prepare("SELECT * FROM kasa");

        if($listeanapara->execute()):

        ?>

        <div class="container">
        <div class="row text-center mt-1 text-center mx-auto">
        <div class="col-lg-12 col-md-12 col-xl-12 mx-auto bg-light">
            <div>

                <div class="col-lg-8 col-md-8 col-xl-8 mx-auto bg-light border border-secondary">
            
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xl-4 text-center text-danger  font-weight-bold border-right border-bottom p-1" >KASA</div>	
                            <div class="col-lg-8 col-md-8 col-xl-8 text-center text-danger  font-weight-bold border-right border-bottom p-1" >İŞLEMLER</div>	
                        </div>
                        
                        <div class="row">
                        
                        <?php 
                        
                        while($listeanaparason=$listeanapara->fetch(PDO::FETCH_ASSOC)):
                        
                        ?>

                            <div class="col-lg-4 col-md-4 col-xl-4 text-center text-dark  font-weight-bold border-right border-bottom p-1" ><?php echo $listeanaparason["anapara"]; ?></div>	
                            <div class="col-lg-8 col-md-8 col-xl-8 text-center text-dark  font-weight-bold border-right border-bottom p-1" >
                            <a href="control.php?islem=bakiyeartır&id=<?php echo $listeanaparason["id"]; ?>" class="btn btn-success">Bakiye Artır</a>
                            <a href="control.php?islem=bakiyeazalt&id=<?php echo $listeanaparason["id"]; ?>" class="btn btn-danger">Bakiye Azalt</a>
                            </div>
                            
                           
                            <?php 
                        
                            endwhile;

                            endif; 
                        
                            ?>
                                
                        </div>
            </div>
    </div>

    </div>

    </div>

</div>

        <?php
    }


    function bakiyeartır($bakiyeartırdb){
		
        ?>
		
		  <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
		
		<?php

        if(isset($_GET["id"])):

            $bakiyegoster=$bakiyeartırdb->prepare("SELECT * FROM kasa WHERE id=".$_GET["id"]);
            $bakiyegoster->execute();
            $bakiyegosterson=$bakiyegoster->fetch(PDO::FETCH_ASSOC);

        endif;

      
        ?>
  
                <form action="" method="POST">

                <h4 class="text-danger">Stok Artır</h4>

                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                <b><p>AnaPara</p></b>
                <p class="text-success font-weight-bold"><?php echo $bakiyegosterson["anapara"]; ?></p>
                </div>

                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                <b><p>Bakiye Artır</p></b>
                <input type="number" name="bakiyemik" min="0" class="form-control">
                </div>
                <br>
                <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                <input type="submit" name="buton" value="Artır" class="btn btn-danger">
                <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                </form>
                </div>					
                        
        <?php

        if(@$_POST["buton"]):

            $urunstok=$bakiyegosterson["anapara"]+$_POST["bakiyemik"];
            $id=$_POST["kayit"];
            

            if(empty($urunstok)):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
              
                header("refresh:2,url=control.php?islem=anaparaliste");


            else:

                $bakiyeguncel=$bakiyeartırdb->prepare("UPDATE kasa SET anapara=:anapara WHERE id=:id");

                $bakiyeguncel->bindParam(":anapara",$urunstok);
                $bakiyeguncel->bindParam(":id",$id);


                if($bakiyeguncel->execute()):
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">'.$_POST["bakiyemik"]. ' : Adet Bakiye Artırıldı </div></div>';
                   
                    header("refresh:2,url=control.php?islem=anaparaliste");


                else:
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                
                    header("refresh:2,url=control.php?islem=anaparaliste");


                endif;

            endif;

        endif;
				
				?>
				
				
				</div>
            
            </div>
            
        </div>
				<?php

    }

    function bakiyeazalt($bakiyeazaltdb){
		
        ?>
		
		  <div class="container bg-light">
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-xl-6 text-center mx-auto mt-2">
                        
		
		<?php

        if(isset($_GET["id"])):

            $bakiyegoster=$bakiyeazaltdb->prepare("SELECT * FROM kasa WHERE id=".$_GET["id"]);
            $bakiyegoster->execute();
            $bakiyegosterson=$bakiyegoster->fetch(PDO::FETCH_ASSOC);

        endif;

      
        ?>
  
                <form action="" method="POST">

                <h4 class="text-danger">Stok Artır</h4>

                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                <b><p>AnaPara</p></b>
                <p class="text-success font-weight-bold"><?php echo $bakiyegosterson["anapara"]; ?></p>
                </div>

                <div class="col-lg-12 col-md-12 col-xl-12 text-center mt-1">
                <b><p>Bakiye Azalt</p></b>
                <input type="number" name="bakiyemik" min="0" class="form-control">
                </div>
                <br>
                <div class="col-lg-12 col-md-12 col-xl-12 mt-1">
                <input type="submit" name="buton" value="Azalt" class="btn btn-danger">
                <input type="hidden" name="kayit" value="<?php echo $_GET["id"]; ?>" class="btn btn-danger">
                </form>
                </div>					
                        
        <?php

        if(@$_POST["buton"]):

            $urunstok=$bakiyegosterson["anapara"]-$_POST["bakiyemik"];
            $id=$_POST["kayit"];
            

            if(empty($urunstok)):
                
                echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">BOŞ BIRAKMA </div></div>';
              
                header("refresh:2,url=control.php?islem=anaparaliste");


            else:

                $bakiyeguncel=$bakiyeazaltdb->prepare("UPDATE kasa SET anapara=:anapara WHERE id=:id");

                $bakiyeguncel->bindParam(":anapara",$urunstok);
                $bakiyeguncel->bindParam(":id",$id);


                if($bakiyeguncel->execute()):
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-success">'.$_POST["bakiyemik"]. ' : Adet Bakiye Azaltıldı </div></div>';
                   
                    header("refresh:2,url=control.php?islem=anaparaliste");


                else:
                    
                    echo '<div class="col-xl-12 col-lg-12 col-md-12 mx-auto"><div class="alert alert-danger">OLMADI </div></div>';
                
                    header("refresh:2,url=control.php?islem=anaparaliste");


                endif;

            endif;

        endif;
				
				?>
				
				
				</div>
            
            </div>
            
        </div>
				<?php


    }




}








?>