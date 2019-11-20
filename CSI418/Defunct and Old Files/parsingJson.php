
<p id ="toBeChanged">this will change</p> 

    <script>
                var ticker = prompt("enter the ticker");
        var linkStart = "https://www.quandl.com/api/v3/datasets/WIKI/";
        var linkEnd = "/data.json?api_key=W8yzMDsJZ_TEcrPjWxGn";
        var link = linkStart + ticker + linkEnd;
        function getDATA(url) {
        var resp ;
        var xmlHttp ;

        resp  = '' ;
        xmlHttp = new XMLHttpRequest();

        if(xmlHttp != null)
        {
            xmlHttp.open( "GET", url, false );
            xmlHttp.send( null );
            resp = xmlHttp.responseText;
        }

        return resp ;
    }

        var json = getDATA(link);
        var obj = JSON.parse(json);
            prompt(json);
        document.getElementById("toBeChanged").innerHTML = obj.dataset_data.data;

    </script>
