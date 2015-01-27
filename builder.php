<?php
class Player {
	protected $video_codec;
	protected $audio_codec;
	protected $height;
	protected $width;
	protected $volume;
	
	public function setVideoCodec($video_codec) {
		$this->video_codec = $video_codec;
		echo $this->video_codec . '<br />';
	}
	
	public function setAudioCodec($audio_codec) {
		$this->audio_codec = $audio_codec;
		echo $this->audio_codec . '<br />';
	}
	
	public function setHeight($height) {
		$this->height = $height;
		echo $this->height . '<br />';
	}
	
	public function setWidth($width) {
		$this->width = $width;
		echo $this->width . '<br />';
	}
	
	public function setVolume($volume) {
		$this->volume = $volume;
		echo $this->volume . '<br />';
	}
	
	public function play($some_data){
        echo $some_data . '<br />';
    }
}

abstract class PlayerBuilder {
	protected $player;
	
	public function createPlayer() {
		$this->player = new Player();
	}
	
	public function getPlayer() {
		return $this->player;
	}
	
	public function play($some_data){
        $this->player->play($some_data);
    }
	
	abstract function setVideoCodec();
	abstract function setAudioCodec();
	abstract function setHeight();
	abstract function setWidth();
	abstract function setVolume();
}

class HDMediaPlayer extends PlayerBuilder {
	public function setVideoCodec() {
		$this->player->setVideoCodec('HD video codec');
	}
	
	public function setAudioCodec() {
		$this->player->setAudioCodec('HD audio codec');
	}
	
	public function setHeight() {
		$this->player->setHeight('HD player height - 500px');
	}
	
	public function setWidth() {
		$this->player->setWidth('HD player width - 800px');
	}
	
	public function setVolume() {
		$this->player->setVolume('HD player volume - 90%');
	}
}

class Mp4MediaPlayer extends PlayerBuilder {
	public function setVideoCodec() {
		$this->player->setVideoCodec('Mp4 video codec');
	}
	
	public function setAudioCodec() {
		$this->player->setAudioCodec('Mp4 audio codec');
	}
	
	public function setHeight() {
		$this->player->setHeight('Mp4 player height - 500px');
	}
	
	public function setWidth() {
		$this->player->setWidth('Mp4 player width - 800px');
	}
	
	public function setVolume() {
		$this->player->setVolume('Mp4 player volume - 90%');
	}
}

class Media {
	private $_builder;

	public function __construct(PlayerBuilder $builder) {
		$this->_builder = $builder;
		$this->_builder->createPlayer();
		$this->_builder->setVideoCodec();
		$this->_builder->setAudioCodec();
		$this->_builder->setHeight();
		$this->_builder->setWidth();
		$this->_builder->setVolume();
	}
	
	public function getPlayer() {
		$this->_builder->getPlayer();
	}
	
	public function play($play) {
		$this->_builder->play($play);
	}
}

$mediaHD = new Media(new HDMediaPlayer);
$mediaHD->play('Укуренные.HD');
$mediaMp4 = new Media(new Mp4MediaPlayer);
$mediaMp4->play('Укуренные.mp4');