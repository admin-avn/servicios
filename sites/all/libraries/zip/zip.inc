7<?php
/* $Id: zip.lib.php,v 2.4 2004/11/03 13:56:52 garvinhicking Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:
/**
* Zip file creation class.
* Makes zip files.
*
* Based on :
*
*  <a href="http://www.zend.com/codex.php?id=535&single=1
" title="http://www.zend.com/codex.php?id=535&single=1
" rel="nofollow">http://www.zend.com/codex.php?id=535&single=1
</a> *  By Eric Mueller <eric@themepark.com>
*
*  <a href="http://www.zend.com/codex.php?id=470&single=1
" title="http://www.zend.com/codex.php?id=470&single=1
" rel="nofollow">http://www.zend.com/codex.php?id=470&single=1
</a> *  by Denis125 <webmaster@atlant.ru>
*
*  a patch from Peter Listiak <mlady@users.sourceforge.net> for last modified
*  date and time of the compressed file
*
* Official ZIP file format: <a href="http://www.pkware.com/appnote.txt
" title="http://www.pkware.com/appnote.txt
" rel="nofollow">http://www.pkware.com/appnote.txt
</a> *
* @access  public
*/
class zipfile
{
    /**
     * Array to store compressed data
     *
     * @var  array    $datasec
     */
    var $datasec      = array();

    /**
     * Central directory
     *
     * @var  array    $ctrl_dir
     */
    var $ctrl_dir     = array();

    /**
     * End of central directory record
     *
     * @var  string   $eof_ctrl_dir
     */
    var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00";

    /**
     * Last offset position
     *
     * @var  integer  $old_offset
     */
    var $old_offset   = 0;


    /**
     * Converts an Unix timestamp to a four byte DOS date and time format (date
     * in high two bytes, time in low two bytes allowing magnitude comparison).
     *
     * @param  integer  the current Unix timestamp
     *
     * @return integer  the current date in a four byte DOS format
     *
     * @access private
     */
    function unix2DosTime($unixtime = 0) {
        $timearray = ($unixtime == 0) ? getdate() : getdate($unixtime);

        if ($timearray['year'] < 1980) {
            $timearray['year']    = 1980;
            $timearray['mon']     = 1;
            $timearray['mday']    = 1;
            $timearray['hours']   = 0;
            $timearray['minutes'] = 0;
            $timearray['seconds'] = 0;
        } // end if

        return (($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) |
                ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1);
    } // end of the 'unix2DosTime()' method


    /**
     * Adds "file" to archive
     *
     * @param  string   file contents
     * @param  string   name of the file in the archive (may contains the path)
     * @param  integer  the current timestamp
     *
     * @access public
     */
    function addFile($data, $name, $time = 0)
    {
        $name     = str_replace('\\', '/', $name);

        $dtime    = dechex($this->unix2DosTime($time));
        $hexdtime = '\x' . $dtime[6] . $dtime[7]
                  . '\x' . $dtime[4] . $dtime[5]
                  . '\x' . $dtime[2] . $dtime[3]
                  . '\x' . $dtime[0] . $dtime[1];
        eval('$hexdtime = "' . $hexdtime . '";');

        $fr   = "\x50\x4b\x03\x04";
        $fr   .= "\x14\x00";            // ver needed to extract
        $fr   .= "\x00\x00";            // gen purpose bit flag
        $fr   .= "\x08\x00";            // compression method
        $fr   .= $hexdtime;             // last mod time and date

        // "local file header" segment
        $unc_len = strlen($data);
        $crc     = crc32($data);
        $zdata   = gzcompress($data,0);
        $zdata   = substr(substr($zdata, 0, strlen($zdata) - 4), 2); // fix crc bug
        $c_len   = strlen($zdata);
        $fr      .= pack('V', $crc);             // crc32
        $fr      .= pack('V', $c_len);           // compressed filesize
        $fr      .= pack('V', $unc_len);         // uncompressed filesize
        $fr      .= pack('v', strlen($name));    // length of filename
        $fr      .= pack('v', 0);                // extra field length
        $fr      .= $name;

        // "file data" segment
        $fr .= $zdata;

        // "data descriptor" segment (optional but necessary if archive is not
        // served as file)
        // nijel(2004-10-19): this seems not to be needed at all and causes
        // problems in some cases (bug #1037737)
        //$fr .= pack('V', $crc);                 // crc32
        //$fr .= pack('V', $c_len);               // compressed filesize
        //$fr .= pack('V', $unc_len);             // uncompressed filesize

        // add this entry to array
        $this -> datasec[] = $fr;

        // now add to central directory record
        $cdrec = "\x50\x4b\x01\x02";
        $cdrec .= "\x00\x00";                // version made by
        $cdrec .= "\x14\x00";                // version needed to extract
        $cdrec .= "\x00\x00";                // gen purpose bit flag
        $cdrec .= "\x08\x00";                // compression method
        $cdrec .= $hexdtime;                 // last mod time & date
        $cdrec .= pack('V', $crc);           // crc32
        $cdrec .= pack('V', $c_len);         // compressed filesize
        $cdrec .= pack('V', $unc_len);       // uncompressed filesize
        $cdrec .= pack('v', strlen($name) ); // length of filename
        $cdrec .= pack('v', 0 );             // extra field length
        $cdrec .= pack('v', 0 );             // file comment length
        $cdrec .= pack('v', 0 );             // disk number start
        $cdrec .= pack('v', 0 );             // internal file attributes
        $cdrec .= pack('V', 32 );            // external file attributes - 'archive' bit set

        $cdrec .= pack('V', $this -> old_offset ); // relative offset of local header
        $this -> old_offset += strlen($fr);

        $cdrec .= $name;

        // optional extra field, file comment goes here
        // save to central directory
        $this -> ctrl_dir[] = $cdrec;
    } // end of the 'addFile()' method


    /**
     * Dumps out file
     *
     * @return  string  the zipped file
     *
     * @access public
     */
    function file()
    {
        $data    = implode('', $this -> datasec);
        $ctrldir = implode('', $this -> ctrl_dir);

        return
            $data .
            $ctrldir .
            $this -> eof_ctrl_dir .
            pack('v', sizeof($this -> ctrl_dir)) .  // total # of entries "on this disk"
            pack('v', sizeof($this -> ctrl_dir)) .  // total # of entries overall
            pack('V', strlen($ctrldir)) .           // size of central dir
            pack('V', strlen($data)) .              // offset to start of central dir
            "\x00\x00";                             // .zip file comment length
    } // end of the 'file()' method

} // end of the 'zipfile' class

function file_create_path($dest = 0) {
  $file_path = file_directory_path();
  if (!$dest) {
    return $file_path;
  }
  // file_check_location() checks whether the destination is inside the Drupal files directory.
  if (file_check_location($dest, $file_path)) {
    return $dest;
  }
  // check if the destination is instead inside the Drupal temporary files directory.
  else if (file_check_location($dest, file_directory_temp())) {
    return $dest;
  }
  // Not found, try again with prefixed directory path.
  else if (file_check_location($file_path .'/'. $dest, $file_path)) {
    return $file_path .'/'. $dest;
  }
  // File not found.
  return FALSE;
}

/**
 * Determine the default 'files' directory.
 *
 * @return A string containing the path to Drupal's 'files' directory.
 */
function file_directory_path() {
  return variable_get('file_directory_path', conf_path() .'/files');
}

/**
 * Returns a persistent variable.
 * 
 * Case-sensitivity of the variable_* functions depends on the database
 * collation used. To avoid problems, always use lower case for persistent
 * variable names.
 *
 * @param $name
 *   The name of the variable to return.
 * @param $default
 *   The default value to use if this variable has never been set.
 * @return
 *   The value of the variable.
 * 
 * @see variable_del(), variable_set()
 */
function variable_get($name, $default) {
  global $conf;

  return isset($conf[$name]) ? $conf[$name] : $default;
}

function conf_path($require_settings = TRUE, $reset = FALSE) {
  static $conf = '';

  if ($conf && !$reset) {
    return $conf;
  }

  $confdir = 'sites';
  $uri = explode('/', $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['SCRIPT_FILENAME']);
  $server = explode('.', implode('.', array_reverse(explode(':', rtrim($_SERVER['HTTP_HOST'], '.')))));
  for ($i = count($uri) - 1; $i > 0; $i--) {
    for ($j = count($server); $j > 0; $j--) {
      $dir = implode('.', array_slice($server, -$j)) . implode('.', array_slice($uri, 0, $i));
      if (file_exists("$confdir/$dir/settings.php") || (!$require_settings && file_exists("$confdir/$dir"))) {
        $conf = "$confdir/$dir";
        return $conf;
      }
    }
  }
  $conf = "$confdir/default";
  return $conf;
}

/**
 * Check if a file is really located inside $directory. Should be used to make
 * sure a file specified is really located within the directory to prevent
 * exploits.
 *
 * @code
 *   // Returns FALSE:
 *   file_check_location('/www/example.com/files/../../../etc/passwd', '/www/example.com/files');
 * @endcode
 *
 * @param $source A string set to the file to check.
 * @param $directory A string where the file should be located.
 * @return 0 for invalid path or the real path of the source.
 */
function file_check_location($source, $directory = '') {
  $check = realpath($source);
  if ($check) {
    $source = $check;
  }
  else {
    // This file does not yet exist
    $source = realpath(dirname($source)) .'/'. basename($source);
  }
  $directory = realpath($directory);
  if ($directory && strpos($source, $directory) !== 0) {
    return 0;
  }
  return $source;
}

/**

/**
 * Save a string to the specified destination.
 *
 * @param $data A string containing the contents of the file.
 * @param $dest A string containing the destination location.
 * @param $replace Replace behavior when the destination file already exists.
 *   - FILE_EXISTS_REPLACE - Replace the existing file
 *   - FILE_EXISTS_RENAME - Append _{incrementing number} until the filename is unique
 *   - FILE_EXISTS_ERROR - Do nothing and return FALSE.
 *
 * @return A string containing the resulting filename or 0 on error
 */
function file_save_data($data, $dest, $replace = FILE_EXISTS_RENAME) {
  $temp = file_directory_temp();
  // On Windows, tempnam() requires an absolute path, so we use realpath().
  $file = tempnam(realpath($temp), 'file');
  if (!$fp = fopen($file, 'wb')) {
    drupal_set_message(t('The file could not be created.'), 'error');
    return 0;
  }
  fwrite($fp, $data);
  fclose($fp);

  if (!file_move($file, $dest, $replace)) {
    return 0;
  }

  return $file;
}

/**
 * Determine the default temporary directory.
 *
 * @return A string containing a temp directory.
 */
function file_directory_temp() {
  $temporary_directory = variable_get('file_directory_temp', NULL);

  if (is_null($temporary_directory)) {
    $directories = array();

    // Has PHP been set with an upload_tmp_dir?
    if (ini_get('upload_tmp_dir')) {
      $directories[] = ini_get('upload_tmp_dir');
    }

    // Operating system specific dirs.
    if (substr(PHP_OS, 0, 3) == 'WIN') {
      $directories[] = 'c:\\windows\\temp';
      $directories[] = 'c:\\winnt\\temp';
      $path_delimiter = '\\';
    }
    else {
      $directories[] = '/tmp';
      $path_delimiter = '/';
    }

    foreach ($directories as $directory) {
      if (!$temporary_directory && is_dir($directory)) {
        $temporary_directory = $directory;
      }
    }

    // if a directory has been found, use it, otherwise default to 'files/tmp' or 'files\\tmp';
    $temporary_directory = $temporary_directory ? $temporary_directory : file_directory_path() . $path_delimiter .'tmp';
    variable_set('file_directory_temp', $temporary_directory);
  }

  return $temporary_directory;
}


function variable_set($name, $value) {
  global $conf;

  $serialized_value = serialize($value);
  db_query("UPDATE {variable} SET value = '%s' WHERE name = '%s'", $serialized_value, $name);
  if (!db_affected_rows()) {
    @db_query("INSERT INTO {variable} (name, value) VALUES ('%s', '%s')", $name, $serialized_value);
  }

  cache_clear_all('variables', 'cache');

  $conf[$name] = $value;
}


?>