/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class GRoleStorehouse extends Rpc.Data
/*    */ {
/*    */   public int capacity;
/*    */   public int money;
/*    */   public Rpc.Data.DataVector items;
/*    */   public byte size1;
/*    */   public byte size2;
/*    */   public Rpc.Data.DataVector dress;
/*    */   public Rpc.Data.DataVector material;
/*    */   public int reserved;
/*    */ 
/*    */   public GRoleStorehouse()
/*    */   {
/* 21 */     this.items = new Rpc.Data.DataVector(new GRoleInventory());
/* 22 */     this.dress = new Rpc.Data.DataVector(new GRoleInventory());
/* 23 */     this.material = new Rpc.Data.DataVector(new GRoleInventory());
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 28 */     os.marshal(this.capacity);
/* 29 */     os.marshal(this.money);
/* 30 */     os.marshal(this.items);
/* 31 */     os.marshal(this.size1);
/* 32 */     os.marshal(this.size2);
/* 33 */     os.marshal(this.dress);
/* 34 */     os.marshal(this.material);
/* 35 */     os.marshal(this.reserved);
/* 36 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 41 */     this.capacity = os.unmarshal_int();
/* 42 */     this.money = os.unmarshal_int();
/* 43 */     os.unmarshal(this.items);
/* 44 */     this.size1 = os.unmarshal_byte();
/* 45 */     this.size2 = os.unmarshal_byte();
/* 46 */     os.unmarshal(this.dress);
/* 47 */     os.unmarshal(this.material);
/* 48 */     this.reserved = os.unmarshal_int();
/* 49 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 56 */       GRoleStorehouse o = (GRoleStorehouse)super.clone();
/* 57 */       o.items = ((Rpc.Data.DataVector)this.items.clone());
/* 58 */       o.dress = ((Rpc.Data.DataVector)this.dress.clone());
/* 59 */       o.material = ((Rpc.Data.DataVector)this.material.clone());
/* 60 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 63 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleStorehouse
 * JD-Core Version:    0.6.2
 */