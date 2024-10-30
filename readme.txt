=== Plugin Name ===
Contributors: nohina
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=4171134
Tags: image, thumbneil, gallery, CD, jacket, イメージ, サムネイル, ギャラリー
Requires at least: 2.6
Tested up to: 2.6
Stable tag: trunk

== Description ==

Changes gallery thumbneils to CD jacket image. 

ギャラリーのサムネイルをCDジャケットの画像に変換するプラグインです。





web site:

<a href="http://island-blog.net/archives/755">Island blog - WordPress、ギャラリーをCDジャケットに入っているように見せるプラグイン「cd gallery」を書いてみた。</a>

== Installation ==

1. Upload all files under repository to the `/wp-content/plugins/cd_gallery/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Write `[cd_gallery]` in your article. You can use like '[gallery]'. Options are same as galllery's and special option 'display_style'. 'display_style' approve parameter 'jewel', 'vinyl' and 'cd'. If doesn't setted 'display_style'
 plugin will chose thumbneil randomly.



１. リポジトリにあるすべてのファイルを`/wp-content/plugins/cd_gallery/`にアップデートします。
２. プラグインメニューでこのプラグインをアクティブにします。 
３. 記事中に`[cd_gallery]`と書いて利用してください。オプションは`[gallery]`関数と同一のものと、'display_style'という特別なオプションがあります。'display_style'にはパラメータとして'jewel'、'vinyl'、'cd'を指定することが出来ます。何も指定しなかった場合はランダムにサムネイルが選ばれます。 



Samples

[cd_gallery]
[cd_gallery display_style="jewel"]
[cd_gallery id=1 display_style="jewel"]

== Screenshots ==

1. jewel
2. vinyl
3. cd

