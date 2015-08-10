(function($) {
    $.fn.reviews = function() {
        var ratingChart     = [
            {
                "min":28,
                "max":30,
                "star":5,
                "text":'Superb'
            },
            {
                "min":25,
                "max":27,
                "star":4.5,
                "text":'Fantastic'
            },
            {
                "min":22,
                "max":24,
                "star":4,
                "text":'Very Good'
            },
            {
                "min":19,
                "max":21,
                "star":3.5,
                "text":'Good'
            },
            {
                "min":16,
                "max":18,
                "star":3,
                "text":'Above Average'
            },
            {
                "min":13,
                "max":15,
                "star":2.5,
                "text":'Average'
            },
            {
                "min":10,
                "max":12,
                "star":2,
                "text":'Below Average'
            },
            {
                "min":7,
                "max":9,
                "star":1.5,
                "text":'Poor'
            },
            {
                "min":4,
                "max":6,
                "star":1,
                "text":'Very Poor'
            },
            {
                "min":0,
                "max":3,
                "star":0.5,
                "text":'Awful'
            }
        ];
        this.change(function() {
            var cleanliness     = $('#matrix_cleanliness').val();
            var location        = $('#matrix_location').val();
            var service         = $('#matrix_staff_service').val();
            var comfort         = $('#matrix_comfort').val();
            var facilities      = $('#matrix_facilities').val();
            var money           = $('#matrix_value_money').val();
            
            if (cleanliness == '') {
                cleanliness = 0;
            }
            
            if (location == '') {
                location = 0;
            }
            
            if (service == '') {
                service = 0;
            }
            
            if (comfort == '') {
                comfort = 0;
            }
            
            if (facilities == '') {
                facilities = 0;
            }
            
            if (money == '') {
                money = 0;
            }
            
            var score           = 0;
            var rating          = 0;
            var starValue       = 0;
            
            // Calculate score & rating.
            score               = parseFloat(cleanliness) + parseFloat(location) + parseFloat(service) + parseFloat(comfort) + parseFloat(facilities) + parseFloat(money);
            rating              = score/6;
            
            for(var i=0; i<ratingChart.length; i++){
                if (score >= ratingChart[i].min && score <= ratingChart[i].max){
                    starValue   = ratingChart[i].star;
                    starPercent = starValue*20;
                    $('#rateTxt').html(ratingChart[i].text);
                    $("#ratePercent").css("width", starPercent + "%");
                    $('#review_rating').val(ratingChart[i].star);
                }
            }
            
            // Display score & rating to their appropiate places.
            $('#review_score').val(score.toFixed(2));
            
        });
    }
}(jQuery));