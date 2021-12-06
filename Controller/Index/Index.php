<?php
namespace TFC\GoogleShopping\Controller\Index;
use Magento\Framework\App\Action\Action as _P;
use TFC\GoogleShopping\Result as R;
use \Closure as F;
/**
 * 2021-12-02
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * "Setup an automatic integration between Magento and Google Merchant Center":
 * https://github.com/tradefurniturecompany/google-shopping/issues/1
 */
class Index extends _P {
	/**
	 * 2021-12-02
	 * @override
	 * @see _P::execute()
	 * @used-by \Magento\Framework\App\Action\Action::dispatch():
	 * 		$result = $this->execute();
	 * https://github.com/magento/magento2/blob/2.4.3-p1/lib/internal/Magento/Framework/App/Action/Action.php#L95-L116
	 * @return R
	 */
	function execute() {return self::p(function() {return [];});}

	/**
	 * 2021-12-03
	 * @used-by execute()
	 * @param F $f
	 * @return R
	 */
	private static function p(F $f) {/** @var array(string => mixed) $r */
		try {
			$r = $f();
		}
		catch (\Exception $e) {
			$r = ['message' => $e->getMessage()];
			df_sentry(__CLASS__, $e);
		}
		return R::i(is_null($r) ? 'OK' : (!is_array($r) ? $r : self::filter($r)));
	}

	/**
	 * 2021-12-03
	 * @used-by filter()
	 * @used-by p()
	 * @param array(string => mixed) $a
	 * @return array(string => mixed)
	 */
	private static function filter(array $a) {
		$r = []; /** @var array(string => mixed) $r */
		foreach ($a as $k => $v) { /** @var string $k */ /** @var mixed $v */
			if (!in_array($v, ['', null], true)) {
				$r[$k] = !is_array($v) ? $v : self::filter($v);
			}
		}
		return $r;
	}
}