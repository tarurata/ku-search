<?php require './scrape.php' ?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <!--CDN for MaterialIcons-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
         <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
         <style type="text/css">
            .v-input__icon--append .v-icon {
                <!--background-color: #FFA000;-->
            }
            .center {
              display: block;
              margin-top: 15px;
              margin-bottom: 5px;
              margin-left: auto;
              margin-right: auto;
              width: 50%;
            }
         </style>
        <meta http-equiv="content-type" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <title>Kindle Unlimited search</title>
    </head>
    <body>

<img src="./logo.jpg" alt="" class="center">

        <div id="app">

        <v-container>
            
            <v-layout align-center justify-center>
            <v-flex xs4 sm6>
            <v-text-field
                label="kindle unlimited の本を検索"
                single-line
                solo
                append-icon="search" class="searchbtn"
                @keypress.enter="kuSearch()"
                @click:append="kuSearch()" 
                id="searchword"
            >
              
            </v-text-field>
            </v-flex>
            </v-layout>

        </v-container>





        <v-layout row wrap>
            <v-flex
                v-for="item in itemdata"
            >
                <v-card 
                    :href="item.link"
                    target="new"
                >
                        <v-img 
                            :src="item.imgsrc" alt=""
                            max-height="120"
                            contain
                        >
                        </v-img>
                        <v-card-title primary-title>{{item.name}}</v-card-title>


                </v-card>
            </v-flex>
        </v-layout>

        </div>





        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
        <script>
            new Vue({ 
                el: '#app',
                methods: {
                    kuSearch(){
                        var searchWord = document.getElementById('searchword').value;
                        var encodedSearchWord = encodeURIComponent(searchWord);
                        //var url = 'https://www.amazon.co.jp/s/ref=sr_nr_p_n_feature_nineteen_0?rh=n%3A2250738051%2Ck%3A' + encodedSearchWord + '%2Cp_n_feature_nineteen_browse-bin%3A3169286051'
                        //window.location.href(`/?k=encodedSearchWord`);
                        window.location.href = '?k=' + encodedSearchWord;
                        
                        //window.open(url);
                    },
                    //kuSearchInsidePage(){
                        //var searchWord = document.getElementById('searchword').value;
                        //var encodedSearchWord = encodeURIComponent(searchWord);
                        //var url = 'https://www.amazon.co.jp/s/ref=sr_nr_p_n_feature_nineteen_0?rh=n%3A2250738051%2Ck%3A' + encodedSearchWord + '%2Cp_n_feature_nineteen_browse-bin%3A3169286051'
                        //<?php 
                            //require('scrape.php');
                            //this.itemdata:[
                            //foreach($items as $item) {
                                //echo '{ name:"'. $item["name"] .'", link: "https://www.amazon.co.jp'. $item["link"] .'", imgsrc:"'. $item["imgsrc"] .'" },';
                            //}
                        //?>
                    }
                },
                data: {
                itemdata: <?= json_encode($items);?>
                    <?php 
                        
                        //foreach($items as $item) {
                            //echo '{ name:"'. $item["name"] .'", link: "https://www.amazon.co.jp'. $item["link"] .'", imgsrc:"'. $item["imgsrc"] .'" },';
                        //}
                    ?>
                }

            })
        </script>
    </body>

