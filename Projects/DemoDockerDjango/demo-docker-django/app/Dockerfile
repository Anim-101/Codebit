# Pulling Official Base Image
FROM python:3.8.3-alpine

# Setting Work Directory
WORKDIR /usr/src/app

# Setting Environment Variables
ENV PYTHONDONTWRITEBYTECODE 1
ENV PYTHONUNBUFFERED 1

# Installing Psycopg2 Dependencies
RUN apk update \
    && apk add postgresql-dev gcc python3-dev musl-dev

# Installing Dependencies
RUN pip install --upgrade pip
COPY ./requirements.txt .
RUN pip install -r requirements.txt

# Copying Project
COPY . .
