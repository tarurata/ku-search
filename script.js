function kuSearch(){
    var searchWord = document.getElementById('searchword').value;
    var encodedSearchWord = encodeURIComponent(searchWord);
    var url = 'https://www.amazon.co.jp/s/ref=sr_nr_p_n_feature_nineteen_0?rh=n%3A2250738051%2Ck%3A' + encodedSearchWord + '%2Cp_n_feature_nineteen_browse-bin%3A3169286051'
    window.open(url);
}
