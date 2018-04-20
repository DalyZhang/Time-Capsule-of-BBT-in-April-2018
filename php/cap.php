<?php

$voice = "http://localhost/timecapsule/audio/1.mp3";

$article = 
"　　赵家遭抢之后，未庄人大抵很快意而且恐慌，阿Q也很快意而且恐慌。但四天之后，阿Q在半夜里忽被抓进县城里去了。那时恰是暗夜，一队兵、一队团丁、一队警察、五个侦探，悄悄地到了未庄，乘昏暗围住土谷祠，正对门架好机关枪；然而阿Q不冲出。许多时没有动静，把总焦急起来了，悬了二十千的赏，才有两个团丁冒了险，逾垣进去，里应外合，一拥而入，将阿Q抓出来；直待擒出祠外面的机关枪左近，他才有些清醒了。

　　到进城，已经是正午，阿Q见自己被搀进一所破衙门，转了五六个弯，便推在一间小屋里。他刚刚一跄踉，那用整株的木料做成的栅栏门便跟着他的脚跟阖上了，其余的三面都是墙壁，仔细看时，屋角上还有两个人。

　　阿Q虽然有些忐忑，却并不很苦闷，因为他那土谷祠里的卧室，也并没有比这间屋子更高明。那两个也仿佛是乡下人，渐渐和他兜搭起来了，一个说是举人老爷要追他祖父欠下来的陈租，一个不知道为了什么事。他们问阿Q，阿Q爽利的答道，“因为我想造反。”";

if ($_POST["code"] === "ABC") {
    echo json_encode([
        "status"     => 0,
        "receiver"   => "Guy",
        "content"    => str_replace(" ", "&nbsp;", str_replace("\r\n", "<br>", $article)),
        "voice"      => null
    ]);
} else {
    echo json_encode([
        "status"     => 0,
        "receiver"   => "Daly",
        "content"    => str_replace(" ", "&nbsp;", str_replace("\r\n", "<br>", "haha\r\n")),
        "voice"      => $voice
    ]);
}