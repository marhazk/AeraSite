/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GRoleData extends Rpc.Data
/*    */ {
/*    */   public GRoleBase base;
/*    */   public GRoleStatus status;
/*    */   public GRolePocket pocket;
/*    */   public GRoleEquipment equipment;
/*    */   public GRoleStorehouse storehouse;
/*    */   public GRoleTask task;
/*    */ 
/*    */   public GRoleData()
/*    */   {
/* 19 */     this.base = new GRoleBase();
/* 20 */     this.status = new GRoleStatus();
/* 21 */     this.pocket = new GRolePocket();
/* 22 */     this.equipment = new GRoleEquipment();
/* 23 */     this.storehouse = new GRoleStorehouse();
/* 24 */     this.task = new GRoleTask();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 29 */     os.marshal(this.base);
/* 30 */     os.marshal(this.status);
/* 31 */     os.marshal(this.pocket);
/* 32 */     os.marshal(this.equipment);
/* 33 */     os.marshal(this.storehouse);
/* 34 */     os.marshal(this.task);
/* 35 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 40 */     os.unmarshal(this.base);
/* 41 */     os.unmarshal(this.status);
/* 42 */     os.unmarshal(this.pocket);
/* 43 */     os.unmarshal(this.equipment);
/* 44 */     os.unmarshal(this.storehouse);
/* 45 */     os.unmarshal(this.task);
/* 46 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 53 */       GRoleData o = (GRoleData)super.clone();
/* 54 */       o.base = ((GRoleBase)this.base.clone());
/* 55 */       o.status = ((GRoleStatus)this.status.clone());
/* 56 */       o.pocket = ((GRolePocket)this.pocket.clone());
/* 57 */       o.equipment = ((GRoleEquipment)this.equipment.clone());
/* 58 */       o.storehouse = ((GRoleStorehouse)this.storehouse.clone());
/* 59 */       o.task = ((GRoleTask)this.task.clone());
/* 60 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 63 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleData
 * JD-Core Version:    0.6.2
 */