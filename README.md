# MCP Light Control Server

This project demonstrates a simple MCP (Modular Command Protocol) server built with PHP and Docker. It includes two tools: `turnOnLights` and `turnOffLights`.

## About This Project

This project was created for demonstration purposes for a Backend Engineering Community meetup.

Please note that **Govee has its own MCP server**, which you can find here:  
🔗 [https://www.piwheels.org/project/mseep-govee-mcp-server/](https://www.piwheels.org/project/mseep-govee-mcpt

## 🛠️ Features

- Dockerized PHP MCP server
- Two MCP tools:
    - `turnOnLights`: Turns the lights on
    - `turnOffLights`: Turns the lights off

## 📦 Requirements

- Docker
- MCP client installed on the host machine

## ⚙️ Setup Instructions

1. Clone this repository and navigate to the project directory.
2. Ensure Docker is installed and running on your system.

## 🐳 Docker Build and Run

### Build the Docker Image

```bash
docker build -t mcp-light-control-server .
```

## 🔌 MCP Client Configuration

To connect your MCP client (running on the host machine) to this Dockerized server, use the following configuration:

```json
{
  "mcpServers": {
    "light-control": {
      "command": "docker",
      "args": ["run", "--rm", "-i", "mcp-light-control-server"]
    }
  }
}
```