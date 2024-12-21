# Set the base image
FROM node:20

# Set working directory
WORKDIR /var/www

# Copy project files into the docker image
COPY ../src .

# Install project dependencies
RUN npm install

# Expose the port Vite runs on
EXPOSE 3000

# Start the Vite server
CMD ["npm", "run", "dev"]