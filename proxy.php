<?php
/*Паттерн Proxy реализует интерфейс родительского класса по своему.*/
class ParentProxy {
	protected $_fileId = 0;
	protected $_pathFile = "";
	protected $_fileSize = 0;
	protected $_fileName = "";
	public $_fileData = 0;
	
	public function loadById($fileId) {
		$this->_fileId = $fileId;
		$this->loadFromDB($fileId);
		$this->_fileData = file_get_contents($this->_pathFile);
	}
	
	public function loadFromDB($fileId) {
		//Здесь происходит выборка из базы, мы её опустим
		$this->_pathFile = "flyweight.php";
		$this->_fileSize = "2Mb";
		$this->_fileName = "flyweight";
	}
}

class RemoteFileProxy extends ParentProxy {
	public function loadById($fileId) {
		//Загружаем только файл из БД, а сам файл не трогаем.
		$this->loadFromDB($fileId);
	}
	
	public function loadFromDB($fileId) {
		//Здесь происходит выборка из базы, мы её опустим
	}
	
	public function getFileContents() {
		if (null === $this->_filedata) {
			$this->_filedata = file_get_contents($this->_filepath);
		}
		return $this->_filedata;
	}
}

class RemoteFileExtendedProxy extends RemoteFileProxy {
    /**
     * @var RemoteFile
     */
    protected $_realRemoteFile = null;

    /**
     * @var int
     */
    protected $_fileId = 0;

    /**
     * Load file by file id
     *
     * @param int $fileId
     */
    public function loadById($fileId)
    {
        $this->_fileId = $fileId;
    }

    public function getFileId()
    {
        return $this->_fileId;
    }

    public function getFileName()
    {
        return $this->_getRealRemoteFile()->getFileName();
    }

    public function getFileSize()
    {
        return $this->_getRealRemoteFile()->getFileSize();
    }

    public function getFileContents()
    {
        return $this->_getRealRemoteFile()->getFileContents();
    }

    /**
     * @return RemoteFileProxy
     */
    public function _getRealRemoteFile()
    {
        if (null == $this->_realRemoteFile) {
            $this->_realRemoteFile = new RemoteFileProxy();
            $this ->_realRemoteFile->loadById($this->_fileId);
        }

        return $this->_realRemoteFile;
    }
}