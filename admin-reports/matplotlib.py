import matplotlib.pyplot as plt
import mysql.connector

# Connect to the MariaDB database
mydb = mysql.connector.connect(
    host="your_host",
    user="your_username",
    password="your_password",
    database="sbdodatabase"
)

# Create a cursor
mycursor = mydb.cursor()

# Function to execute SQL query and fetch results
def execute_query(query):
    mycursor.execute(query)
    return mycursor.fetchall()

# Function to generate monthly report data
def generate_monthly_report(year, month):
    appointment_query = f"""
        SELECT a.Time_Created, COUNT(a.Appointment_ID)
        FROM appointment a
        WHERE MONTH(a.Time_Created) = {month} AND YEAR(a.Time_Created) = {year}
        GROUP BY DAY(a.Time_Created)
    """
    appointment_data = execute_query(appointment_query)

    days = [data[0].day for data in appointment_data]
    appointment_counts = [data[1] for data in appointment_data]
    
    return days, appointment_counts

# Function to plot line graph
def plot_line_graph(x, y, xlabel, ylabel, title):
    plt.plot(x, y, marker='o')
    plt.xlabel(xlabel)
    plt.ylabel(ylabel)
    plt.title(title)
    plt.grid(True)
    plt.show()

# Example usage
year = 2024
month = 5
days, appointment_counts = generate_monthly_report(year, month)
plot_line_graph(days, appointment_counts, "Day of Month", "Number of Appointments", f"Monthly Appointments Report ({year}-{month})")
