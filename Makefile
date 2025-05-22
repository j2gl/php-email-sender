

default: start


# --------------------------
# start
# --------------------------
start:
	docker compose up -d

# --------------------------
# stop
# --------------------------
stop:
	docker compose stop

# --------------------------
# stop
# --------------------------
down:
	docker compose down

# --------------------------
# logs
# --------------------------
logs:
	docker compose logs -f -n 1000

