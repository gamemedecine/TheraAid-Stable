import json, requests

file = open("./patients.json", "r")
jsons = json.loads(file.read())

for i, j in enumerate(jsons):
    i = i + 1

    username = j["username"]
    firstName = j["firstName"]
    middleName = j["middleName"]
    lastName = j["lastName"]
    password = j["password"]
    email = j["email"]
    mobileNumber = j["mobileNumber"]
    birthday = j["birthday"]
    patientCase = j["patientCase"]
    patientCaseDescription = j["patientCaseDescription"]
    address = j["address"]

    url = "http://localhost/projects/TheraAid-Stable/PatientRegistration.php"
    formData = {
        "username": username,
        "firstName": firstName,
        "middleName": middleName,
        "lastName": lastName,
        "password": password,
        "email": email,
        "mobileNumber": mobileNumber,
        "birthDate": birthday,
        "patientCase": patientCase,
        "patientCaseDescription": patientCaseDescription,
        "location": address
    }

    files = [
        ("profilePicture[]", open(f"./UserFiles/PatientProfilePictures/{i}.jpg", "rb")),

        ("assesmentImage[]", open("./UserFiles/assesment-1.png", "rb")),
        ("assesmentImage[]", open("./UserFiles/assesment-2.jpg", "rb")),
        
        ("medicalHistoryImage[]", open("./UserFiles/history-1.jpg", "rb")),
        ("medicalHistoryImage[]", open("./UserFiles/history-2.jpg", "rb")),
        ("medicalHistoryImage[]", open("./UserFiles/history-3.jpg", "rb")),
    ]

    response = requests.post(url=url, data=formData, files=files)

    if not response.status_code == 200:
        with open("./patient_log.html", "w") as file:
            file.write(response.text)
        break
    else: print(response.status_code)