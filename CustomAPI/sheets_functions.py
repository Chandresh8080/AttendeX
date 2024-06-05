import pygsheets
import pandas as pd
import datetime

def update_google_sheet(enrollment_number, sheet_name, flag=False):
    try:
        gc = pygsheets.authorize(service_file='g-maps-route-api-4a6aac3d364c.json')
        # Open the Google spreadsheet
        sh = gc.open(sheet_name)

        # Select the first sheet
        wks = sh[0]
        print(f"Initiating {enrollment_number} update")

        # Get current date
        current_datetime = datetime.datetime.now()
        formatted_datetime = current_datetime.strftime("%d/%m/%Y")

        column_a_values = wks.get_col(1, include_tailing_empty=False)
        first_row_values = wks.get_row(1)
        filled_columns_count = sum(1 for value in first_row_values if value)

        last_date = wks.get_value((1, filled_columns_count))

        # Create a dataframe for the date
        date = pd.DataFrame(columns=[formatted_datetime])

        # Update particular cell using enrollment number
        if formatted_datetime != last_date:
            wks.set_dataframe(date, (1, filled_columns_count + 1))
            filled_columns_count += 1

        if enrollment_number in column_a_values:
            row_index = column_a_values.index(
                enrollment_number) + 1  # Adding 1 because indexing in Google Sheets starts from 1
            wks.update_value((row_index, filled_columns_count), "Present")
        else:
            # If enrollment number is not present, add it at the end of the sheet
            filled_rows_count = len(column_a_values)
            wks.update_value((filled_rows_count + 1, 1), enrollment_number)
            wks.update_value((filled_rows_count + 1, filled_columns_count), "Present")

            # Add present in enrollment number
            cell = wks.cell((filled_rows_count + 1, 1))
            cell.color = (1, 1, 0.8, 1)
            cell.value = enrollment_number
            cell.update()

        return "Succes"  # Entry successful, return "yes"
    except Exception as e:
        print("Error:", e)
        return "Faliure"  # Entry failed, return "no"
