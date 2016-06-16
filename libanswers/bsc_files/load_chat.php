var springSpace = springSpace || {};

(function(){
	
	if (!window.console) {
		var noOp = function(){}; // no-op function
		console = {
			log: noOp,
			warn: noOp,
			error: noOp
		}
	}

	var chat_div, chat_load, chat_timer, chat_self_triggered, chat_button;
	var libchat_options = {"id":"558","iid":"544","hash":"6ccc78fc41155c6516c472e2f439fd75","name":"Summon","ts":"2014-08-25T13:31:08.951Z","uid":487,"ref":"","key":"b91d0f95390292b","chat_title":"Welcome to LibChat!","byeMsg":"Thanks for chatting!","dept_label":"Select Department:","name_label":"Name","name_default":"","guest_label":"Guest","width":"100%","height":340,"is_personal":true,"chat_button":"Start Chat","done_button":"Chat again","press_enter":"Press ENTER to send","submit_button":"Submit","email_trans":"View\/Email Transcript","offline_text":"Ask Us","offline_url":"","slidebutton_url":"","slidebutton_url_off":"","slidebutton_text":"Chat Help","slidebutton_text_off":"Ask Us","slidebutton_position":"r","slidebutton_bcolor":"#F58220","slidebutton_color":"#FFFFFF","slidebutton_width":"","slidebutton_height":"","la_hide":false,"la_hide_msg":"Sorry, chat is offline but you can still get help.","la_hide_msg2":"<a href=\"http:\/\/libanswers.buffalostate.edu\" target=\"_parent\">Search our Knowledgebase and\/or submit your question<\/a>","la_search_opt":{"group_id":0,"button":"Search","placeholder":"","label":""},"la_search_box":"<div id=\"s-la-content-search-558\" class=\"s-la-content-search s-la-content\"><form method=\"get\" name=\"s-la-searchform\" id=\"s-la-searchform-558\" action=\"\" onsubmit=\"return false;\" target=\"_parent\" role=\"search\" aria-labelledby=\"s-la-content-search-query-558\"><div class=\"form-group\"><label for=\"s-la-content-search-query-558\" class=\"s-la-searchform-label sr-only control-label\"><\/label><input type=text id=s-la-content-search-query-0 class=\"s-la-content-search-query form-control\" name=\"q\" placeholder=\"\" value=\"\" autocomplete=off \/><\/div><div class=\"form-group\"><button class=\"btn btn-sm btn-default s-la-searchform-button\" type=\"submit\" style=\"background-color: #3278e0; border-color: #3278e0; color: #FFFFFF;\">Search<\/button><\/div><\/form><\/div>","sound_on":"Sound is On (click to toggle)","sound_off":"Sound is Off (click to toggle)","star_text":"Please rate this chat:","rate_1":"Bad","rate_2":"So-so","rate_3":"Good","rate_4":"Great","trans":"Enter an email address to send this chat transcript to:","error_sess":"Error starting session.","error_send":"Error sending this message.","error_tran":"Error sending transcript.","left":" has left the chat","typing":" is typing...","joined":" has joined the chat","initial_question":true,"initial_question_label":"Your Question","comments_label":"Any comments?","comments_button_text":"Submit Feedback","enable_anon":false,"enable_comments":true,"enable_sound":false,"star_ratings":true,"file_uploads":false,"file_title":"Upload File","file_intro":"Note: Maximum file size is 5MB. File is removed after one month, it is not kept permanently.","file_label":"Attach a file","file_action":"Upload","cancel_button":"Cancel","css":"","custom_css":"h2 { color: #c60;}\na {color:#8cc63f; } \n","color_backg":"#f9f9f9","color_head":"#3278e0","color_btn":"#FFFFFF","color_border":"","user1":{"tag":1,"name":"Status","id":0,"show":1,"required":0,"type":"l","val":"Undergraduate, Graduate, Faculty, Staff, Alumni \/ Visitor, Other"},"user2":{"tag":2,"name":"E-mail","id":0,"show":1,"required":0,"type":"t","val":""},"user3":{"tag":3,"name":"click to edit","id":0,"show":0,"required":0,"type":"t","val":""},"user4":{"tag":4,"name":"click to edit","id":0,"show":0,"required":0,"type":"t","val":""},"user5":{"tag":5,"name":"click to edit","id":0,"show":0,"required":0,"type":"t","val":""},"error_off":"Sorry it doesn't appear any librarians are online... Please try again later.","wait":"Please wait... A librarian will connect shortly!","depart_id":"0","depart_dedicated":true,"depart_default_id":"0","widget_type":1,"autoload_time":0,"autoload_head":"Do you need help?","autoload_text":"A librarian is online ready to help.","autoload_yes":"Chat Now","autoload_no":"No Thanks","wtype":2,"isBuilding":true,"missedchat_time":"45","missedchat_message":"We apologize for the delay. Don't want to wait?","missedchat_link":"Submit your question.","missedchat_queue":"204","fbwidget":false,"autopop":false,"peel":"","skip_login":false,"nologin_message":"Type your question in the box below and press Enter to start chatting.","error_message":"Sorry, it looks like you're having a connection issue. Would you like to submit your question for email follow-up?","error_link":"Submit your question.","error_queue":0,"away_message":"Chat is online but the operator is temporarily away. If you don't want to wait, you can submit your question for email follow-up.","away_link":"Submit your question.","away_queue":0,"reload_button":"Recheck Status","base_domain":"v2.libanswers.com","onlinerules":[{"d":0,"u":0}]};
	var cascadeServer = "https:\/\/cascade2.libchat.com:443";
	
		
	//!check jquery version up to second decimal
	//is the current version >= minimum version
	function minVersion(minv, curr) {
		curr = curr || window.jQuery.fn.jquery;
		var c = curr.split('.');
		var m = minv.split('.');
		
		if (parseInt(c[0], 10) > parseInt(m[0], 10)) { return true; }
		else if (parseInt(c[0], 10) < parseInt(m[0], 10)) { return false; }
		else {
			if (typeof c[1] == 'undefined') { c[1] = 0; }
			if (typeof m[1] == 'undefined') { m[1] = 0; }
			if (parseInt(c[1], 10) > parseInt(m[1], 10)) { return true; }
			else if (parseInt(c[1], 10) < parseInt(m[1], 10)) { return false; }
			else { return true; }
		}
	}

	//get jquery either from namespace, window, or by loading it
	if (typeof springSpace.jq == "undefined") {
		if (window.jQuery === undefined) {
			loadJquery();
		} else {
			if (minVersion('1.7', window.jQuery.fn.jquery)) {
				springSpace.jq = window.jQuery;
				main();
			} else {
				loadJquery();
			}
		}
	} else {
		main();
	}		
	
	//!Load jQuery
	function loadJquery(){
		var script_tag = document.createElement('script');
		script_tag.setAttribute("type","text/javascript");
		script_tag.setAttribute("src", "//code.jquery.com/jquery-1.12.2.min.js");
		if (script_tag.readyState) { // for IE
			script_tag.onreadystatechange = function () {
				if (this.readyState == 'complete' || this.readyState == 'loaded') {
					scriptLoadHandler();
				}
			};
		} else {
			script_tag.onload = scriptLoadHandler;
		}
		(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
	}		
		
	//!Called once jQuery has loaded
	function scriptLoadHandler() {
		springSpace.jq = window.jQuery.noConflict(true);
		main();
	}		

	//!Check online status
	function checkStatus() {
				
			springSpace.jq.ajax({
				url : cascadeServer+'/widget_status',
				dataType : "jsonp",
				data: { iid: libchat_options.iid, rules: JSON.stringify(libchat_options.onlinerules) },
				success : function(data) {
					var online = false;
					if (data.u || data.d) {
						online = true;
					}
					showChat(online);
				},
				timeout: 10000
			}).fail(function(){
				showChat(false);
			});
			}
			
	function main() {
	
		springSpace.jq(document).ready(function(){
		
					
			//change a % width to some standard pixel width for new window
			if (typeof libchat_options.width == 'string' && libchat_options.width.indexOf('%') !== -1) {
				libchat_options.width = '400';
			}
				
		
		//only load a stylesheet if there was a custom one set
		if (libchat_options.css !== '') {
			if(document.createStyleSheet) {
				try { document.createStyleSheet(libchat_options.css); } catch (e) { }
			}
			else {
				var css_tag = document.createElement("link");
				css_tag.setAttribute("rel", "stylesheet");
				css_tag.setAttribute("type", "text/css");
				css_tag.setAttribute("href", libchat_options.css);
				(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(css_tag);
			}
		}			
		if (!libchat_options.color_border || libchat_options.color_border == '') { libchat_options.color_border = 'transparent'; }
		
					
			//default to libchat_hash, but fallback for early v2 widgets
			chat_div = springSpace.jq('#libchat_'+libchat_options.hash);
			if (chat_div.length == 0) {
				libchat_options.containerID = 'libchat_btn_widget';				chat_div = springSpace.jq('#'+libchat_options.containerID);
			} else {
				libchat_options.containerID = 'libchat_'+libchat_options.hash;
			}
		
			//Get Status for non-slide-outs
			// @todo I don't think we need to do that for embed widgets. They are just checking the status AGAIN in chati.php
			checkStatus();
				
					
			}); //end docready
	}//end main

	function showChat(online){
		var qs = window.location.protocol+'//'+libchat_options.base_domain+'/chati.php?';
		qs += "iid=" + libchat_options.iid + 
			 "&hash=" + libchat_options.hash;

		if (typeof libchat_options['template'] !== 'undefined') {
			qs += "&template="+encodeURIComponent(libchat_options['template']);
		}
		
		if (typeof libchat_options['template_css'] !== 'undefined') {
			qs += "&template_css="+encodeURIComponent(libchat_options['template_css']);
		}		
		qs += "&online="+online;
		
		try {
			if ( typeof libchat_options.width === 'string' && libchat_options.width.indexOf("%") == -1 )
				libchat_options.width = parseInt(libchat_options.width,10);
		} catch(e){}

		try {
			if ( typeof libchat_options.height === 'string' && libchat_options.height.indexOf("%") == -1 )
				libchat_options.height = parseInt(libchat_options.height,10);
		} catch(e){}
		
		if (window.document.title) {
			qs += '&referer_title='+encodeURIComponent(window.document.title);
		}
		
						var $img = springSpace.jq('<img>').addClass('libchat_btn_img').css({ width: libchat_options.slidebutton_width, height: libchat_options.slidebutton_height });
				var $link = springSpace.jq('<a>');
					
				if (online){
					qs += '&referer='+encodeURIComponent(window.location.href); //referer for IE
					if (libchat_options.slidebutton_url !== '') {
						$img.attr('src', libchat_options.slidebutton_url).attr('alt', libchat_options.slidebutton_text);
						$link.attr('href', '#');
						$link.append($img);
					} else {
						$link = springSpace.jq('<button>').html(libchat_options.slidebutton_text).addClass('libchat_online').css({ display: 'inline-block', padding: '6px 12px', marginBottom: 0, textAlign: 'center', whiteSpace: 'nowrap', verticalAlign: 'middle', cursor: 'pointer', backgroundImage: 'none', border: '1px solid transparent', borderRadius: '4px', backgroundColor: libchat_options.slidebutton_bcolor, color: libchat_options.slidebutton_color });
					}
					
					$link.on('click', function(e){
						e.preventDefault();
						window.open(qs, 'libchat', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width='+libchat_options.width+', height='+libchat_options.height);
					});
					
					if (libchat_options.slidebutton_url !== '') {
						$link.append($img);
					}
					
				} else {

					if (libchat_options.slidebutton_url_off !== '') {
						$img.attr('src', libchat_options.slidebutton_url_off).attr('alt', libchat_options.slidebutton_text_off);
						if (libchat_options.offline_url == '') {
							$link.attr('href', '#').on('click', function(e){
								e.preventDefault();
								window.open(qs, 'libchat', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width='+libchat_options.width+', height='+libchat_options.height);
							});
						} else {
							$link.attr('href', libchat_options.offline_url);
						}
						
						$link.append($img);
						
					} else {
						$link = springSpace.jq('<button>').html(libchat_options.slidebutton_text_off).addClass('libchat_offline').css({ display: 'inline-block', padding: '6px 12px', marginBottom: 0, textAlign: 'center', whiteSpace: 'nowrap', verticalAlign: 'middle', cursor: 'pointer', backgroundImage: 'none', border: '1px solid transparent', borderRadius: '4px', backgroundColor: libchat_options.slidebutton_bcolor, color: libchat_options.slidebutton_color });;
						if (libchat_options.offline_url == '') {
							$link.on('click', function(e){
								e.preventDefault();
								window.open(qs, 'libchat', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width='+libchat_options.width+', height='+libchat_options.height);
							});
						} else {
							$link.on('click', function(e){
								e.preventDefault();
								window.location.href = libchat_options.offline_url;
							});				
						}
					}
				}
				
				chat_div.html($link);
				
						
		
	}//end showchat

})(); //end anonymous function
