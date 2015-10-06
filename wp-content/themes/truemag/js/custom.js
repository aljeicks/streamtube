( function($) {
        // we can now rely on $ within the safety of our "bodyguard" function
        
		$(document).ready(function(){
			
                        $("#btnCustomLink").click(function(){
                            var tagLink = $("#txtTagLink").val();
                            var url = "{BASE_URL}/component/k2/itemlist/tag/" + tagLink;
                            $("#K2ExtraField_18").val(url);
                            alert("done!");
                        });
		});
                
                function GetSourceAndPopulateData(){
                    var imdbId = $("#txtIMDBId2").val();
                    var catId = $("#catid").val();
                    var buttonId = "#btnGetSourceTVStreaming";
                    GetIMDBData(imdbId, catId, buttonId, GetSourceFromTVStreaming);
                    //GetSourceFromTVStreaming();
                }
		
		function GetIMDBData(imdbId, catId, buttonId, callback){
			//var imdbId = $("#txtIMDBId").val();
			//var catId = $("#catid").val();
			var buttonText = $(buttonId).text();
			if(catId != "0")
			{
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
					
					$("#title").val(movietitle);
					$("#alias").val(moviealias);
					$("#K2ExtraField_2").val(data.Director);
					$("#K2ExtraField_3").val(data.Writer);
					$("#K2ExtraField_4").val(data.Actors);
					$("#K2ExtraField_5").val(data.Year);
					$("#K2ExtraField_6").val(data.Rated);
					$("#K2ExtraField_7").val(data.Runtime);
					$("#K2ExtraField_8").val(data.Genre);
					$("#K2ExtraField_9").val(data.Language);
					$("#K2ExtraField_10").val(data.Metascore);
					$("#K2ExtraField_11").val(data.imdbRating);
					$("#K2ExtraField_12").val(imdbId);
					$("#K2ExtraField_14").val(data.Country);
					$("#K2ExtraField_15").val(data.Released);
                                        $("#K2ExtraField_16").val(data.Season);
                                        $("#K2ExtraField_17").val(data.Episode);
                                        
					if(data.Poster != null && data.Poster != ''){
						$("#colImdbPoster").html(data.Poster);
					}
					
					var html = '<li class="addedTag">#value<span class="tagRemove" onclick="$K2(this).parent().remove();">x</span><input type="hidden" value="#value" name="tags[]"></li>';
					
					// remove existing tags
					$("li.tagAdded").replaceWith("");
					$("li.addedTag").replaceWith("");
					
					// add the genres as tags
					var genres = data.Genre.split(",");
					$(genres).each(function( index ) {
						$(html.replace(/#value/g,this)).insertBefore("ul li.tagAdd");
					});
                                        
                                        if(data.Type == "episode"){
                                            var title = $("#txttvseriestitle").val();
                                            $("#spanRemarks").html(title + " (Season " + data.Season + " Episode " + data.Episode + ")");
                                            var _title = $("#title").val();
                                            $("#title").val(title + " (Season " + data.Season + " Episode " + data.Episode + "): " + _title);
                                            
                                            var tvseriesalias = title.replace(/ /g, "-") + "-" + "-Season-" + data.Season + "-" + "Episode-" + data.Episode;
                                            $("#alias").val(tvseriesalias);
                                            
                                            title = title.replace(/ /g, "");
                                            
                                            $(html.replace(/#value/g, title)).insertBefore("ul li.tagAdd");
                                            $(html.replace(/#value/g, title + "Season" + data.Season)).insertBefore("ul li.tagAdd");
                                            
                                            //$("#catid").val("132");
                                            //$("#catid").change();
                                        }
                                        
					// add the year as tags
					$(html.replace(/#value/g,data.Year)).insertBefore("ul li.tagAdd");
					
					// add the actors as tags
					var actors = data.Actors.split(",");
					$(actors).each(function( index ) {
						$(html.replace(/#value/g,this)).insertBefore("ul li.tagAdd");
					});
					
					
					tinymce.activeEditor.setContent('');
					jInsertEditorText(data.Plot, 'jform_articletext');
					
					// if character counter > 100, use read more
					/*if(data.Plot.length > 100){
						jInsertEditorText(data.Plot.substr(0, 100), 'jform_articletext');
						$("a.btn[title='Read More']").click();
						jInsertEditorText(data.Plot.substr(100, data.Plot.length - 1), 'jform_articletext');
					}else{
						jInsertEditorText(content, 'jform_articletext');
					}*/
					$(buttonId).removeAttr("disabled");
					$(buttonId).text(buttonText);
                                        
                                        if(callback != null && typeof callback == 'function'){
                                            callback();
                                        }else{
                                            alert("done populating!");
                                        }
					
				}).fail(function(data) {
					$(buttonId).removeAttr("disabled");
					$(buttonId).text(buttonText);
					alert('Error found! Please contact web administrator.');
				});
			} 
			else 
			{
				alert("Please select category.");
			}
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