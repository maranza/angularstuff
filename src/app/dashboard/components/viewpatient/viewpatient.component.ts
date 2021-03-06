import { Component, OnInit } from '@angular/core';
import { PatientService } from '../../../services/patient.service';
import { Router, ActivatedRoute } from '@angular/router';
import { Patient } from '../../../models/patient';
@Component({
  selector: 'app-viewpatient',
  templateUrl: './viewpatient.component.html',
  styleUrls: ['./viewpatient.component.css']
})
export class ViewpatientComponent implements OnInit {

  patient: Patient = new Patient;
  constructor(private patientService: PatientService,
    private router: Router,
    private route: ActivatedRoute) { }

  ngOnInit() {

    const uuid: string = this.route.snapshot.paramMap.get('uuid');

    this.patientService.getRecord(uuid).subscribe(data => {

        this.patient = data;
      },
        err => {
          alert(err);
      });

  }

  updatePatient(): void {

    this.patientService.updateRecord(this.patient).subscribe(data => {

        this.router.navigate(['dashboard/view']);
    },
    err => {
      alert(err);

    });

  }

}
