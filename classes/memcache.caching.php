<?

class CacheMemcache {
   
    var $iTtl = 600; // Time To Live
    var $bEnabled = false; // Memcache enabled?
    var $oCache = null;
 
    // constructor
    function CacheMemcache() {
        if (class_exists('Memcache')) {
            $this->oCache = new Memcache();
            $this->bEnabled = true;
            if (! $this->oCache->connect('localhost', 11211))  { // Instead 'localhost' here can be IP
                $this->oCache = null;
                $this->bEnabled = true;
            }
        }
    }

    // get data from cache server
    function getData($sKey) {
        $vData = $this->oCache->get($sKey);
        return false === $vData ? null : $vData;
    }

    // save data to cache server
    function setData($sKey, $vData) {
        //Use MEMCACHE_COMPRESSED to store the item compressed (uses zlib). 
        return $this->oCache->set($sKey, $vData, 0, $this->iTtl);
    }

    // delete data from cache server
    function delData($sKey) {
        return $this->oCache->delete($sKey);
    }
}

?>