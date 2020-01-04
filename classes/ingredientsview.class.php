<?php

class ingredientsview extends ingredients {

	public $total_data;
	public $total_page;
	public $start;

	public function id($id) {
		$results = $this->SELECT($id);
		return $results;
	}

	public function idType($id) {
		$results = $this->SELECTT($id);
		return $results;
	}

	public function type() {
		$results = $this->ALLTYPE();
		return $results;
	}

	public function wait($search) {
		$results = $this->SELECTFORWAIT($search);
		return $results;
	}

	public function search($search) {
		$results = $this->SELECTNAME($search);
		return $results;
	}

	public function getAll($numberOfType) {
		$results = $this->ALLOF($numberOfType);
		return $results;
	}

	public function getType($status, $numberOfType) {
		$results = $this->SELECTALLTYPE($status, $numberOfType);
		return $results;
	}

	public function getTypeWithSearch($numberOfType, $search) {
		$results = $this->SELECTWITHTEXT($numberOfType, $search);
		return $results;
	}

	public function pagination($search, $row, $currentPage) {
		$foods = self::search($search);
		$this->total_data = count($foods);
		$this->total_page = ceil($this->total_data / $row);
		$this->start = ($currentPage - 1) * $row;
		return $data = $this->SELECTLIMIT($search, $this->start, $row);
	}

	public function navPagination(int $currentPage) {
		if ($currentPage < 1) {
			$currentPage = 1;
		}

		if ($currentPage > $this->total_page) {
			$currentPage = $this->total_page;
		}

		$pre = $currentPage - 1;
		$nex = $currentPage + 1;

		if ($pre < 0) {
			$pre = 0;
		}

		echo "<nav aria-label='Page navigation example'>";
		echo "<ul class='pagination justify-content-center'>";

		if ($currentPage != 1) {
			if ($currentPage == 0) {
				echo "<li class='page-item disabled'><a class='page-link' href='?p=$pre'> <i class='fad fa-angle-double-left animated fadeOutLeft delay-1s infinite slow'></i> </a></li>";
			} else {
				echo "<li class='page-item'><a class='page-link' href='?p=$pre'> <i class='fad fa-angle-double-left animated fadeOutLeft delay-1s infinite slow'></i> </a></li>";
			}
		} else {
			echo "<li class='page-item disabled'><a class='page-link' href='?p=$pre'> <i class='fad fa-angle-double-left animated fadeOutLeft delay-1s infinite slow'></i> </a></li>";

		}

		if ($currentPage <= 4) {
			for ($prev = 4; $prev > 0; $prev--) {
				$pre = $currentPage - $prev;
				if ($pre > 0) {
					echo "<li class='page-item'><a class='page-link' href='?p=$pre'> $pre </a></li>";
				}
			}
		} else {
			echo "<li class='page-item'><a class='page-link' href='?p=1'> 1 </a></li>";
			echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			for ($prev = 3; $prev > 0; $prev--) { 
				$pre = $currentPage - $prev;
				echo " <a class='page-link' href='?p=$pre'> $pre </a></li>";
			}
		}

		echo "<li class='page-item active'><a class='page-link' href='?p=$currentPage'> $currentPage </a></li>";

		$last = $this->total_page - 3;

		if ($currentPage >= $last) {
			for ($next = $currentPage + 1; $next <= $this->total_page ; $next++) { 
				if ($next > $this->total_page) {
					$next = $this->total_page;
				}
				echo "<li class='page-item'><a class='page-link' href='?p=$next'> $next </a></li>";
			}
		}else{
			for ($next = $currentPage + 1; $next <= $this->total_page ; $next++) { 
				if ($next > $this->total_page) {
					$next = $this->total_page;
				}
				echo "<li class='page-item'><a class='page-link' href='?p=$next'> $next </a></li>";
			}
			echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
			echo "<li class='page-item'><a class='page-link' href='?p=$this->total_page'> $this->total_page </a></li>";
		}
		if ($nex > $this->total_page) {
			$nex = $this->total_page;
		}
		if ($currentPage != $this->total_page) {
			echo "<li class='page-item'><a class='page-link' href='?p=$nex'> <i class='fad fa-angle-double-right animated fadeOutRight delay-1s infinite slow'></i> </a></li>";
		}else{
			echo "<li class='page-item disabled'><a class='page-link' href='?p=$nex'> <i class='fad fa-angle-double-right animated fadeOutRight delay-1s infinite slow'></i> </a></li>";
		}

		echo '</ul>';
		echo '</nav>';
	}

}

?>