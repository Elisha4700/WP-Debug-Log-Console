<?php 

	class DebugLogHandler{
		
		private $lines;
		private $lines_array;
		private $formed_html;
		private $debug_log;

		function __construct( $document_location ){
			$this->debug_log = $document_location;
			$this->lines_array = array();
			$this->read_document();
		}

		function get_log(){
			$this->formed_html = '';

			foreach( $this->lines_array as $line ){
				$this->formed_html .= '<div class="line">' . $line . '</div>';
			}

			return $this->formed_html; //array_unique($this->lines_array); //$this->lines_array;
		}


		function parse_line( $line ){
			// removes the [12-Jan-2012 17:37:40] from the line
			$line = preg_replace( '%(\[\d+\-\w+\-\d+\s\d+:\d+:\d+\]\s)(PHP)%', '',  $line);
			return trim( $line );
		}

		function read_document(){
			$this->lines = file( $this->debug_log );
			$is_stack = false;

			foreach( $this->lines as $line ){
				if( !empty( $line ) ){
					array_push($this->lines_array, $this->parse_line( $line ) );
				}
			}

			$this->lines_array = array_unique($this->lines_array);
		}


	}