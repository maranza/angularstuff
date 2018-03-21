import { Component, OnInit } from '@angular/core';
import { Patient } from '../models/patient';
import { PatientService } from '../services/patient.service';
import { Observable } from 'rxjs/Observable';
@Component({
  selector: 'app-viewpatient',
  templateUrl: './viewpatient.component.html',
  styleUrls: ['./viewpatient.component.css']
})
export class ViewpatientComponent implements OnInit {
  patients: Patient[];
  records: Observable<Patient[]>;
  constructor(private patientService: PatientService) { }

  ngOnInit() {
    this.records = this.patientService.getRecords();
    this.patientService.getRecords().subscribe(data => {

      if (data['error']) {

        alert('Failed to retrive record');

      }
      else {

        this.patients = data;
      }

    });
  }
  deletePatient(index: any): void {

    this.patientService.deleteRecord(this.patients[index].IdNumber).subscribe(data => {

      if (data['error']) {

        alert(data['error']);
      }
      else {

        this.patients.splice(index, 1);

      }

    });

  }

}
