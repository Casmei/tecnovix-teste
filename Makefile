# Makefile

start:
	@echo "Configurando o ambiente..."
	php artisan key:generate
	docker-compose build
	docker-compose up -d
	@echo "Aguardando o serviço 'app' iniciar..."
	@sleep 10 # Aguarda um tempo para garantir que o serviço esteja em execução
	docker-compose exec -T app php artisan migrate:fresh --seed

.PHONY: start
