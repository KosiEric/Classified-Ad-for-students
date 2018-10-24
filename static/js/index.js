$(document).ready(function () {


    var loadMoreAction = $(loadMore);


    if(loadMoreAction){



        var sql1 = String.format("WHERE posted_by != '{0}' AND closed != '{1}'" , '123' , 1);

        loadMoreAds(sql1 , null , loadMoreDefaultAdsFile);

        loadMoreAction.on('click' , function () {
            loadMoreAds(sql1 , null , loadMoreDefaultAdsFile);
        });


    }



});