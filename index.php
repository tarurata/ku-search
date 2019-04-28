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

         </style>
        <meta http-equiv="content-type" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <title>Kindle Unlimited search</title>
    </head>
    <body>

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

        <ul>
            <li v-for="item in itemData">
                {{ item.item }}
            </li>
        </ul>

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
                        var url = 'https://www.amazon.co.jp/s/ref=sr_nr_p_n_feature_nineteen_0?rh=n%3A2250738051%2Ck%3A' + encodedSearchWord + '%2Cp_n_feature_nineteen_browse-bin%3A3169286051'
                        window.open(url);
                    }
                },
                data: {
                    itemData:[
                    <?php 
                        require('scrape.php');
                        foreach($items as $item) {
                            echo '{ item:"'. $item .'" },';
                        }
                    ?>
                    ]
                }

            })
        </script>
    </body>

