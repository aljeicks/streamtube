( function($) {
        // we can now rely on $ within the safety of our "bodyguard" function
        
		$(document).ready(function(){
                    $("#btnCustomLink").click(function(){
                       var tagLink = $("#txtTagLink").val();
                       var url = "{BASE_URL}/component/k2/itemlist/tag/" + tagLink;
                       $("#K2ExtraField_18").val(url);
                       alert("done!");
                   });
                   
                   $("#btnImdb").click(function(){
                       GetIMDBData($("#imdb_id").val(), "#btnImdb");
                   });
		});
                
		function GetIMDBData(imdbId, buttonId){
			var buttonText = $(buttonId).text();
                        $.ajax({
                                url: "http://www.omdbapi.com/?i="+ imdbId +"&plot=full&r=json",
                                dataType : 'json',
                                beforeSend: function() {
                                        $(buttonId).text("Processing..");
                                        $(buttonId).attr("disabled", "disabled");
                                }
                        }).done(function(data) {
                                var movietitle = data.Title + " (" + data.Year + ")";
                                data.Title = data.Title.replace(/,/g, "");
                                var moviealias = data.Title.replace(/ /g, "-") + "-" + data.Year.replace(/ /g, "-");
                                $("#title").focus();
                                $("#title").val(movietitle);
                                $("#acf-field-poster_image").val(data.Poster);
                                $("#acf-field-imdb_id").val(imdbId);
                                $("#acf-field-year").val(data.Year);
                                $("#acf-field-rated").val(data.Rated);
                                $("#acf-field-released").val(data.Released);
                                $("#acf-field-runtime").val(data.Runtime);
                                $("#acf-field-genre").val(data.Genre);
                                $("#acf-field-director").val(data.Director);
                                $("#acf-field-writer").val(data.Writer);
                                $("#acf-field-language").val(data.Language);
                                $("#acf-field-awards").val(data.Awards);
                                $("#acf-field-metascore").val(data.Metascore);
                                $("#acf-field-imdb_rating").val(data.imdbRating);
                                $("#acf-field-imdb_votes").val(data.imdbVotes);
                                tinyMCE.get('content').setContent(data.Plot);
                                
                                
                                var tags = data.Year + "TV Series";
                                tags += "," + data.Genre;
                                tags += "," + data.Actors;
                                tags += "," + data.Rated;
                                tags += "," + data.Director;
                                tags += "," + data.Writer;
                                tags += "," + data.Language;
                                tags += "," + data.Country;
                                
                                $("#new-tag-post_tag").val(tags);
                                $(".tagadd").click();
                                
                                
                                $(buttonId).removeAttr("disabled");
                                $(buttonId).text(buttonText);
                                
                                alert("done populating!");

                        }).fail(function(data) {
                                $(buttonId).removeAttr("disabled");
                                $(buttonId).text(buttonText);
                                alert('Error found! Please contact web administrator.');
                        });
		}
		
		function GetIMDBId(){
			var videoid = $("#txtmovietubevideoid").val();
			
			$.ajax({
				url: baseURL + "geturl.php?id=" + videoid,
				dataType : 'html',
				beforeSend: function(){
					$("#btnGetImdb").text("Processing..");
					$("#btnGetImdb").attr("disabled", "disabled");
				}
			}).done(function(data) {
				$("#txtIMDBId").val(data);
				$("#K2ExtraField_13").val("id=" + videoid + "&src=1");
				$("#btnGetImdb").removeAttr("disabled");
				$("#btnGetImdb").text("Get IMDB");
				alert("done getting the imdb id!");
			}).fail(function(data) {
				$("#btnGetImdb").removeAttr("disabled");
				$("#btnGetImdb").text("Get IMDB");
				alert('Error found! Please contact web administrator.');
			});
		}
                
                function GetSourceFromTVStreaming(){
                    //http://localhost/sjasolar/getvideo.php?id=RVFX6zcP3f0&src=2&ep=01&part=01
                    var videoid = $("#txttvstreamingid").val();
                    var episode = $("#K2ExtraField_17").val();
                    if(episode == ""){
                        alert("Unable to set source. Kindly check the episode column.");
                        return;
                    }
                    
                    episode = (episode.length < 2) ? ("0" + episode) : episode;
                    
                    $("#K2ExtraField_13").val("id=" + videoid + "&src=2" + "&part=01&ep=" + episode);
                    alert("done getting source and populating data!");
                    
                }
		
 } ) ( jQuery );