<?php
declare(strict_types = 1);

namespace Pluginkollektiv\AntispamBee;

use Pluginkollektiv\AntispamBee\Entity\DataInterface;
use Pluginkollektiv\AntispamBee\Handler\SpamHandlerInterface;
use Pluginkollektiv\AntispamBee\Repository\FilterRepository;

class SpamChecker {


	private $spamHandler;
	private $repository;
	private $spam_reason;

	public function __construct( SpamHandlerInterface $spamHandler, FilterRepository $repository ) {
		$this->repository  = $repository;
		$this->spamHandler = $spamHandler;
	}

	/**
	 * Checks the data and if its detected as being spam, the SpamHandler will be executed.
	 *
	 * @param DataInterface $data The data to check.
	 *
	 * @return bool
	 */
	public function check( DataInterface $data ) : bool {

		if ( $this->no_spam_check( $data ) ) {
			return false;
		}

		$is_spam = $this->spam_check( $data );

		if ( $is_spam ) {
			$this->spamHandler->execute( $this->spam_reason, $data );
		}
		return $is_spam;

	}

	private function no_spam_check( DataInterface $data ) {
		$probability = 0;

		foreach ( $this->repository->active_nospam_filters() as $filter ) {
			if ( $probability >= 1 ) {
				continue;
			}

			$propability_for_filter = $filter->filter( $data );
			$probability           += $propability_for_filter;
		}

		return $probability > .5;
	}

	private function spam_check( DataInterface $data ) {
		$probability = 0;

		foreach ( $this->repository->active_spam_filters() as $filter ) {
			if ( $probability >= 1 ) {
				continue;
			}
			if ( $probability >= 1 ) {
				continue;
			}

			$propability_for_filter = $filter->filter( $data );
			$probability           += $propability_for_filter;
			if ( $probability >= 1 ) {
				$this->spam_reason = $filter->id();
			}
		}

		return $probability > .5;
	}
}
