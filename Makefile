IMAGE_NAME=mcp-light-control-server

build:
	docker build -t $(IMAGE_NAME) .

bash:
	docker run -it --rm -v $(PWD):/app -w /app $(IMAGE_NAME) bash

start:
	docker run --rm -it $(IMAGE_NAME)