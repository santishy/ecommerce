<?php

namespace App;
class PayPal{
	private $_apiContext;
	private $shoppingCart;
	private $_clientId='AVFlmFoXKSRgugi6J4UQa2Rmmry54Vfy_jEm6dE770XppCCb8u1dU641SsVd0u_-bynp-dO2C_WeEN6B';
	private $_clientSecret='EB0gn3RBrBsEBRLcVQ6y4gGaQWSSeHHCxyM05kOk3tnp8oc_PR3V1XIhjKYwnyFfs1S-_SlB7mXWyXH9';
	public function __construct($shoppingCart)
	{
		$this->_apiContext=\PaypalPayment::ApiContext($this->_clientId,$this->_clientSecret);
		$config=config('paypal_payment');
		$flatConfig=array_dot($config);
		$this->_apiContext->setConfig($flatConfig);
		$this->shoppingCart=$shoppingCart;
	}
	public function generete()
	{
		$payment=\PaypalPayment::payment()->setIntent('sale') // que tipo de movimiento es
		->setPayer($this->payer()) //informacion del pagador
		->setTransactions([$this->transaction()])
		->setRedirectUrls($this->redirectUrls());
		try
		{
			$payment->create($this->_apiContext);
		}
		catch(\Exception $ex)
		{
			dd($ex);
			exit(1);
		}
		return $payment;
	}
	public function payer()
	{
		return \PaypalPayment::payer()
		    ->setPaymentMethod('paypal');
	}
	public function transaction()
	{
		return \PaypalPayment::transaction()
		   ->setAmount($this->amount())
		   ->setItemList($this->items())
		   ->setDescription('PRODUCTOS CODIGO FACILITO')
		   ->setInvoiceNumber(uniqid());

	}
	public function items()
	{
		$items=[];
		$products=$this->shoppingCart->products()->get();
		foreach($products as $product)
		{
			array_push($items, $product->paypalItem());
		}
		return \PaypalPayment::itemList()->setItems($items);
	}
	public function amount()
	{
		return \PaypalPayment::amount()->setCurrency('USD')
			->setTotal($this->shoppingCart->total());
	}
	public function redirectUrls(){
		$BaseUrl=url('/');
		return \PaypalPayment::redirectUrls()
			->setReturnUrl($BaseUrl."/payments/store")
			->setCancelUrl($BaseUrl."/carrito");
	}
	public function execute($paymentId,$payerId)
	{
		$payment=\PaypalPayment::getById($paymentId,$this->_apiContext);
		$execution=\PaypalPayment::PaymentExecution()->setPayerId($payerId);
		return $payment->execute($execution,$this->_apiContext);
	}

}