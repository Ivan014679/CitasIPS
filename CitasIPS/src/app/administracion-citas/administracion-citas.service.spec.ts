import { TestBed } from '@angular/core/testing';

import { AdministracionCitasService } from './administracion-citas.service';

describe('AdministracionCitasService', () => {
  let service: AdministracionCitasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AdministracionCitasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
