import os, shutil

def clearChatsDirs():
    for i in os.scandir("../Chats"):
        if i.is_dir():
            shutil.rmtree(i, ignore_errors=True)

def clearUserFiles():
    parentDir = "UserFiles"

    licensePicDir = "LicensePictures"
    patientAssementPicturesDir = "PatientAssementPictures"
    patientMedicalHistoryPicturesDir = "PatientMedicalHistoryPictures"
    profilePicturesDir = "ProfilePictures"

    for i in os.listdir(f"../{parentDir}/{licensePicDir}"):
        if len(i.split(".")) >= 2:
            os.remove(f"../{parentDir}/{licensePicDir}/{i}")

    for i in os.listdir(f"../{parentDir}/{patientAssementPicturesDir}"):
        if len(i.split(".")) >= 2:
            os.remove(f"../{parentDir}/{patientAssementPicturesDir}/{i}")

    for i in os.listdir(f"../{parentDir}/{patientMedicalHistoryPicturesDir}"):
        if len(i.split(".")) >= 2:
            os.remove(f"../{parentDir}/{patientMedicalHistoryPicturesDir}/{i}")

    for i in os.listdir(f"../{parentDir}/{profilePicturesDir}"):
        if len(i.split(".")) >= 2:
            os.remove(f"../{parentDir}/{profilePicturesDir}/{i}")

if __name__ == "__main__":
    clearUserFiles()
    clearChatsDirs()