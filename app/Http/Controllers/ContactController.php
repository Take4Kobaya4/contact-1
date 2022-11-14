<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Repositories\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ContactController extends Controller
{

    public function __construct(protected CompanyRepository $company)
    {
    }

    public function index(CompanyRepository $company, Request $request)
    {
        $companies = $company->pluck();
        $contacts = Contact::latest()->where(function ($query) {
            if ($companyId = request()->query("company_id")) {
                $query->where("company_id", $companyId);
            }
        })->paginate(10);

        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show')->with('contact', $contact);
    }
}
