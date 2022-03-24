<?php require './scrape.php' ?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TC4H87M');</script>
        <!-- End Google Tag Manager -->

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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TC4H87M"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<img src="./logo.jpg" alt="" class="center">

        <div id="app">

        <v-container>
            <v-layout align-center justify-center>
            <v-flex xs4 sm6 center>
            <v-text-field
                label="kindle unlimited の本を検索"
                single-line
                solo
                append-icon="search" 
                class="searchbtn"
                @keypress.enter="kuSearch()"
                @click:append="kuSearch()" 
                id="searchword"
            >
              
            </v-text-field>
            </v-flex>
            </v-layout>



        <v-flex xs12>
        <v-layout row wrap>
                <v-card 
                    width="33%"
                    class="mx-auto"
                    v-for="item in itemdata"
                    :href="item.link"
                    target="new"
                >
                        <v-flex >
                        <v-img 
                            :src="item.imgsrc" alt=""
                            max-height="200"
                            contain
                        >
                        </v-img>
                        </v-flex>

                        <v-flex >
                        <v-card-title primary-title>
                            <div>{{item.name.substring(0, 20)}}</div>
                        </v-card-title>
                        </v-flex>

                </v-card>
        </v-layout>
        </v-flex>
        </v-container>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            new Vue({ 
                el: '#app',
                methods: {
                    kuSearch(){
                        var searchWord = document.getElementById('searchword').value;
                        var encodedSearchWord = encodeURIComponent(searchWord);
                        window.location.href = '?k=' + encodedSearchWord;
                        
                    }
                },
                data: {
                    itemdata: <?= json_encode($items);?>
                }
                //mounted () {
                    //axios
                        //.get('https://api.coindesk.com/v1/bpi/currentprice.json')
                        //.then(response => (this.info = response.data.bpi))
                //}

            })
        </script>
    </body>

