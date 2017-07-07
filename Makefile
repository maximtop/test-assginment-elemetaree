install:
	composer install
	php yii migrate --interactive=0

serve:
	php yii serve

weather:
	php yii weather