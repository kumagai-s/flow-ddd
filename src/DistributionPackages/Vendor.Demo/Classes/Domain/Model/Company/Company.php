<?php

declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Company;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Account;
use Vendor\Demo\Domain\Model\Employee\Employee;
use Vendor\Demo\Domain\Model\Employee\EmployeeEmail;
use Vendor\Demo\Domain\Model\Employee\EmployeeName;

/**
 * @Flow\Entity
 *
 * @ORM\Table(name="companies")
 */
class Company
{
    /**
     * @ORM\Embedded(columnPrefix=false)
     */
    protected CompanyName $name;

    /**
     * @ORM\ManyToMany(targetEntity=Account::class, inversedBy="companies", cascade={"persist"})
     *
     * @ORM\JoinTable(name="companies_accounts", joinColumns={@ORM\JoinColumn(name="company_id")}, inverseJoinColumns={@ORM\JoinColumn(name="account_id")})
     *
     * @var Collection<Account>
     */
    protected $accounts;

    /**
     * @ORM\OneToMany(targetEntity=Employee::class, mappedBy="company")
     *
     * @var Collection<Employee>
     */
    protected $employees;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->employees = new ArrayCollection();
    }

    public function getname(): CompanyName
    {
        return $this->name;
    }

    public function setName(CompanyName $newName): void
    {
        $this->name = $newName;
    }

    public function getAccounts(): ArrayCollection|PersistentCollection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): void
    {
        if ($this->accounts->contains($account)) {
            return;
        }

        $this->accounts->add($account);
    }

    public function removeAccount(Account $account): void
    {
        $this->accounts->removeElement($account);
    }

    public function getEmployees(): ArrayCollection|PersistentCollection
    {
        return $this->employees;
    }

    public function addEmployee(
        EmployeeName $name,
        EmployeeEmail $email,
    ): Employee {
        if ($this->employees->exists(fn (Employee $e) => $e->getEmail()->equals($email))) {
            throw new \InvalidArgumentException('Employee already exists');
        }

        // Todo: クライアントにメールを送信して、アカウントの登録を完了させる

        $employee = new Employee();
        $employee->setName($name);
        $employee->setEmail($email);

        return $employee;
    }

    public function removeEmployee(Employee $employee): void
    {
        $this->employees->removeElement($employee);
    }
}
