//页面初始化
$("body").height($(window).height());
$("#main-query").fadeIn(500);
window.history.replaceState({}, 0, "#query");
	
//事件
$(window).on("hashchange", (function () {
	var page = "query", audio = document.getElementById("audio");
	return function () {
		// 旧页淡出及之后触发的事件
		$("#main-" + page).fadeOut(500, function () {
			switch (page) {
				case "query":
					$("#input").val("");
					$("#poll").text("提交");
					break;
				case "text":
					//这里暂时还没有什么事做
					break;
				case "audio":
					audio.pause();
					$("#pause").addClass("hidden");
					$("#play").removeClass("hidden");
			}
			// 设置当前页为新页
			page = window.location.hash.slice(1);
			switch (page) {
				case "query":
					$("#background").fadeIn(200);
					break;
				case "text":
					$("#background").fadeOut(200);
					break;
				case "audio":
					$("#background").fadeIn(200);
			}
			// 新页淡入
			$("#main-" + page).fadeIn(500);
		});
	};
})());

//输入文本时转化为大写
$("#input").on("input", function () {
	setTimeout(function () {
		$(this).val($(this).val().toUpperCase());
	}, 0);
});

//输入框得到焦点时报错文本消失
$("#input").on("focus", function () {
	$("#errmsg").text("");
})

$("#poll").on("click", function () {
	// 前端过滤
	var input = $("#input").val();
	if (input === "") {
		$("#errmsg").text("输入的兑换码不对哦");
		return;
	}
	// 按钮查找状态
	$("#poll").text("梯仔找信中");
	// 后台过滤并检索
	$.ajax({
		type: "POST",
		data: {code: input},
		url: "php/capsule.php",
		success: function (data) {
			try {
				data = JSON.parse(data);
			} catch (error) {
				$("#errmsg").text("输入的兑换码不对哦");
				return;
			}
			switch (data.status) {
				case 0:
					// 正常
					if (data.voice === null) {
						$("#text").html(data.content);
						window.location.hash = "#text";
					} else {
						$("#audio").attr("src", data.voice);
						window.location.hash = "#audio";
					}
					$("#errmsg").text("");
					break;
				// 异常
				case 1:
					$("#errmsg").text("输入的兑换码不对哦");
					break;
				case 404:
					$("#errmsg").text("输入的兑换码不对哦");
					break;
				default:
					$("#errmsg").text("输入的兑换码不对哦");
			}
			//按钮结束状态
			$("#poll").text("提交");
		}
	});
})

// 播放器按钮
$("#circle2").on("click", (function () {
	var audio = document.getElementById("audio");
	return function () {
		if (audio.paused) {
			audio.play();
			$("#play").addClass("hidden");
			$("#pause").removeClass("hidden");
		} else {
			audio.pause();
			$("#pause").addClass("hidden");
			$("#play").removeClass("hidden");
		}
	};
})());